/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var page = 1;



function callPage(id)
{
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            document.getElementById("content").innerHTML = xhr.responseText;
            document.getElementById("container").className = "page_" + page;
        }
    };

    document.getElementById("content").innerHTML = '<div id="loader"></div>';
    xhr.open('GET', 'content.php?page=' + id, true);
    xhr.send(null);
}