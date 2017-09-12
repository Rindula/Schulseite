package com.example.wahid.e2;

import android.text.TextUtils;
import android.util.Log;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.nio.charset.Charset;
import java.util.ArrayList;
import java.util.Iterator;
import java.util.List;

/**
 * Created by Wahid on 3/5/2017.
 */

public final class QueryUtilsHW {


    public static final String LOG_TAG = MainActivity.class.getName();

    private static URL createUrl(String stringUrl) {
        URL url = null;
        try {
            url = new URL(stringUrl);
        } catch (MalformedURLException e) {
            Log.e(LOG_TAG, "Problem building the URL ", e);
        }
        return url;
    }

    private static String makeHttpRequest(URL url) throws IOException {
        String jsonResponse = "";


        if (url == null) {
            return jsonResponse;
        }

        HttpURLConnection urlConnection = null;
        InputStream inputStream = null;
        try {
            urlConnection = (HttpURLConnection) url.openConnection();
            urlConnection.setReadTimeout(10000 /* milliseconds */);
            urlConnection.setConnectTimeout(15000 /* milliseconds */);
            urlConnection.setRequestMethod("GET");
            urlConnection.connect();


            if (urlConnection.getResponseCode() == 200) {
                inputStream = urlConnection.getInputStream();
                jsonResponse = readFromStream(inputStream);
            } else {
                Log.e(LOG_TAG, "Error response code: " + urlConnection.getResponseCode());


            }
        } catch (IOException e) {
            Log.e(LOG_TAG, "Problem retrieving the JSON results.", e);
        } finally {
            if (urlConnection != null) {
                urlConnection.disconnect();
            }
            if (inputStream != null) {

                inputStream.close();
            }
        }
        return jsonResponse;
    }


    private static String readFromStream(InputStream inputStream) throws IOException {
        StringBuilder output = new StringBuilder();
        if (inputStream != null) {
            InputStreamReader inputStreamReader = new InputStreamReader(inputStream, Charset.forName("UTF-8"));
            BufferedReader reader = new BufferedReader(inputStreamReader);
            String line = reader.readLine();
            while (line != null) {
                output.append(line);
                line = reader.readLine();
            }
        }
        return output.toString();
    }


    private QueryUtilsHW() {
    }


    private static List<Homework> extractFeatureFromJson(String homeworkJSON) {
        if (TextUtils.isEmpty(homeworkJSON)) {
            return null;
        }


        List<Homework> homeworks = new ArrayList<>();


        try {


            JSONArray homeworksArrayW = new JSONArray(homeworkJSON);
            JSONArray homeworksArray = homeworksArrayW.getJSONArray(0);
            for (int i = 0; i < homeworksArray.length(); i++) {


                JSONObject currentHomework = homeworksArray.getJSONObject(i);
                Iterator<String> iter = currentHomework.keys();
                String key = iter.next();
                JSONObject lightObject = currentHomework.getJSONObject(key);
                String fach = lightObject.getString("fach");
                String aufgaben = lightObject.getString("aufgaben");
                String datum = lightObject.getString("datum");


                Homework homework = new Homework(fach, aufgaben, datum);

                homeworks.add(homework);
            }

        } catch (JSONException e) {

            Log.e("QueryUtilsHW", "Problem parsing the JSON results", e);
        }


        return homeworks;
    }


    public static List<Homework> fetchHomeworksData(String requestUrl) {


        URL url = createUrl(requestUrl);


        String jsonResponse = null;
        try {
            jsonResponse = makeHttpRequest(url);
        } catch (IOException e) {
            Log.e(LOG_TAG, "Problem making the HTTP request.", e);
        }


        List<Homework> homeworks = extractFeatureFromJson(jsonResponse);

        return homeworks;
    }


}
