/*
 *
 * Part-DB Version 0.4+ "nextgen"
 * Copyright (C) 2016 - 2018 Jan Böhmer
 * https://github.com/jbtronics
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA
 *
 */

//import ajaxui from "./ajax_ui";

/**
 * Opens the given Link in the #content div
 * @param {string} page The URL that should be opened. (Must be on Part-DB)
 */
function openLink(page : string) {
    'use strict';
    $('#content').load(page + " #content-data");
}

/**
 * Add the given param to a existing URL.
 * @param {string} url The URL which should be modified.
 * @param {string} param The param (in Form "key=value", or simply key) which should be appended to the URL
 * @returns {string} The url with the appended parameter.
 */
function addURLparam(url : string, param : string) : string
{
    'use strict';

    let hash = "";

    if(url.indexOf("#") != -1)
    {
        hash = url.substring(url.indexOf("#"));
        url = url.replace(hash, "");
    }

    //If url already contains a ? than use a & for param addition
    if(url.indexOf('?') >= 0)
    {
        url = url + "&" + param;
    }
    else  //Else use a ?
    {
        url =  url + "?" + param;
    }

    return url + hash;

}

/**
 * Removes the given param from the url.
 * @param {string} url The URL which should be modified.
 * @param {string} param The param (in Form "key=value", or simply key) which should be removed from the URL
 * @returns {string} The url without the specified parameter.
 */
function removeURLparam(url : string, param : string) : string
{
    'use strict';
    return url.replace("&" + param, "").replace("?" + param, "")
}

/**
 * Submit the given Form and shows a loading bar, if the form doesn't have a ".no-progbar" class.
 * @param form The Form which should be submited.
 */
function submitForm(form) : void{
    'use strict';
    ajaxui.submitForm(form);
}

/**
 * Submit a form, via the given Button (it's value gets appended to request)
 * Needed when the submit buttons in the form has the "submit" class and we has to submit the form manually.
 * @param form The form which should be submited.
 * @param btn The button, which was pressed to submit the form.
 */
function submitFormSubmitBtn(form, btn) :void{
    ajaxui.submitFormSubmitBtn(form, btn);
}

/**
 * Extract the title (The name between the <title> tags) of a HTML snippet.
 * @param {string} html The HTML code which should be searched.
 * @returns {string} The title extracted from the html.
 */
function extractTitle(html : string) : string {
    let title : string = "";
    let regex = /<title>(.*?)<\/title>/gi;
    if (regex.test(html)) {
        let matches = html.match(regex);
        for(let match in matches) {
            title = $(matches[match]).text();
        }
    }
    return title;
}

/**
 * Opens the given URL in a new tab.
 * @param {string} url The URL which should be opened in a new Tab.
 */
function openInNewTab(url : string) {
    //$("<a>").attr("href", url).attr("target", "_blank")[0].click();
    window.open(url,'_newtab');
}

/**
 * Scrolls Up, if a message is shown.
 * @returns {boolean}
 */
function scrollUpForMsg()
{
    if($("#messages").length)
    {
        $('#back-to-top').tooltip('hide');
        $('body,html').animate({
            scrollTop: 0
        }, 400);
        return false;
    }
}

/**
 * Scroll to the given anchor.
 * @param {string} anchor The anchor, to which should be scrolled (with the #)
 */
function scrollToAnchor(anchor : string) : void
{
    if(anchor == "#") {
        return;
    }

    //Dont throw an error, simply do nothing, when it dont contain a #
    if(anchor.indexOf("#") !== -1) {
        $(document).scrollTop($(anchor).offset().top - 100);
    }
}

/**
 * Returns the base path of Part-DB
 * @returns {string} The base path.
 */
function getBasePath() : string
{
    return String($("#basepath").val());
}


/**
 * Reloads the current Page.
 */
function reloadPage()
{
    openLink(document.location.href);
}
