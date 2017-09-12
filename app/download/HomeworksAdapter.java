package com.example.wahid.e2;

import android.app.Activity;
import android.content.Context;
import android.graphics.drawable.GradientDrawable;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;

import java.util.ArrayList;


/**
 * Created by Wahid on 3/5/2017.
 */

public class HomeworksAdapter extends ArrayAdapter<Homework> {
    public HomeworksAdapter(Activity context, ArrayList<Homework> homeworks) {
        super(context, 0,homeworks);
    }




    @Override
    public View getView(int position, View convertView, ViewGroup parent) {


        View listItemView = convertView;
        if (listItemView == null) {
            listItemView = LayoutInflater.from(getContext()).inflate(
                    R.layout.hw_listviw_item, parent, false);
        }
        Homework currentHomework = getItem(position);
        String fach = currentHomework.getmFach();
        TextView fachView = (TextView) listItemView.findViewById(R.id.hw_fach);
        fachView.setText(fach);
        String aufgaben = currentHomework.getmAufgaben();
        TextView aufgabenView = (TextView) listItemView.findViewById(R.id.hw_aufgaben);
        aufgabenView.setText(aufgaben);
        String datum = currentHomework.getmzieldatum();
        TextView datumView = (TextView) listItemView.findViewById(R.id.hw_zieldatum);
        datumView.setText(datum);


        return listItemView;
    }
}

