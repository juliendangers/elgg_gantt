<?php


?>.gantt, .gantt2 {
    width: 100%;
    margin: 20px auto;
    border: 14px solid #ddd;
        -webkit-border-radius: 6px;
        -moz-border-radius: 6px;
        border-radius: 6px;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
}

.gantt:after {
    content: ".";
    visibility: hidden;
    display: block;
    height: 0;
    clear: both;
}

.fn-gantt {
    width: 100%;
}

.fn-gantt .fn-content {
    overflow: hidden;
    position: relative;
    width: 100%;
}




/* === LEFT PANEL === */

.fn-gantt .leftPanel {
    float: left;
    width: 225px;
    overflow: hidden;
    border-right: 1px solid #DDD;
    position: relative;
    z-index: 20;
}

.fn-gantt .row {
    float: left;
    height: 24px;
    line-height: 24px;
    margin-left: -24px;
}

.fn-gantt .leftPanel .fn-label {
    display: inline-block;
    margin: 0 0 0 5px;
    color: #484A4D;
    width: 110px;
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
}

.fn-gantt .leftPanel .row0 {
    border-top: 1px solid #DDD;
}
.fn-gantt .leftPanel .name, .fn-gantt .leftPanel .desc {
    float: left;
    height: 23px;
    margin: 0;
    border-bottom: 1px solid #DDD;
    background-color: #f6f6f6;
}

.fn-gantt .leftPanel .name {
    width: 110px;
    font-weight: bold;
}

.fn-gantt .leftPanel .desc {
    width: 115px;
}

.fn-gantt .spacer {
    margin: -2px 0 1px 0;
    border-bottom: none;
    background-color: #f6f6f6;
}




/* === RIGHT PANEL === */

.fn-gantt .rightPanel {
    overflow: hidden;
}

.fn-gantt .dataPanel {
    margin-left: 0px;
    border-right: 1px solid #DDD;
    background-image: url(<?php echo $vars['url']; ?>mod/gantt/graphics/grid.png);
    background-repeat: repeat;
    background-position: 24px 24px;
}
.fn-gantt .day {
    overflow: visible;
    width: 24px;
    line-height: 24px;
    text-align: center;
    border-left: 1px solid #DDD;
    border-bottom: 1px solid #DDD;
    margin: -1px 0 0 -1px;
    font-size: 11px;
    color: #484a4d;
    text-shadow: 0 1px 0 rgba(255,255,255,0.75);
    text-align: center;
}

.fn-gantt .holiday {
    background-color: #ffd263;
    height: 23px;
    margin: 0 0 -1px -1px;
}

.fn-gantt .today {
    background-color: #fff8da;
    height: 23px;
    margin: 0 0 -1px -1px;
    font-weight: bold;
    text-align: center;
}

.fn-gantt .sa, .fn-gantt .sn, .fn-gantt .wd {
    height: 23px;
    margin: 0 0 0 -1px;
    text-align: center;
}

.fn-gantt .sa, .fn-gantt .sn {
    color: #939496;
    background-color: #f5f5f5;
    text-align: center;
}

.fn-gantt .wd {
    background-color: #f6f6f6;
    text-align: center;
}

.fn-gantt .rightPanel .month, .fn-gantt .rightPanel .year {
    float: left;
    overflow: hidden;
    border-left: 1px solid #DDD;
    border-bottom: 1px solid #DDD;
    height: 23px;
    margin: 0 0 0 -1px;
    background-color: #f6f6f6;
    font-weight: bold;
    font-size: 11px;
    color: #484a4d;
    text-shadow: 0 1px 0 rgba(255,255,255,0.75);
    text-align: center;
}

.fn-gantt-hint {
    border: 5px solid #edc332;
    background-color: #fff5d4;
    padding: 10px;
    position: absolute;
    display: none;
    z-index: 11;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
}

.fn-gantt .bar {
    background-color: #D0E4FD;
    height: 18px;
    margin: 4px 3px 3px 3px;
    position: absolute;
    z-index: 10;
    text-align: center;
        -webkit-box-shadow: 0 0 1px rgba(0,0,0,0.25) inset;
        -moz-box-shadow: 0 0 1px rgba(0,0,0,0.25) inset;
        box-shadow: 0 0 1px rgba(0,0,0,0.25) inset;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
}

.fn-gantt .bar .fn-label {
    line-height: 18px;
    font-weight: bold;
    white-space: nowrap;
    width: 100%;
    text-overflow: ellipsis;
    overflow: hidden;
    text-shadow: 0 1px 0 rgba(255,255,255,0.4);
    color: #414B57 !important;
    text-align: center;
    font-size: 11px;
}

.fn-gantt .ganttRed {
    background-color: #F9C4E1;
}
.fn-gantt .ganttRed .fn-label {
    color: #78436D !important;
}
.fn-gantt .ganttBlue {
	background-color: #D0E4FD
}

.fn-gantt .ganttGreen {
    background-color: #D8EDA3;
}
.fn-gantt .ganttGreen .fn-label {
    color: #778461 !important;
}

.fn-gantt .ganttOrange {
    background-color: #FCD29A;
}
.fn-gantt .ganttOrange .fn-label {
    color: #714715 !important;
}


/* === BOTTOM NAVIGATION === */

.fn-gantt .bottom {
    clear: both;
    background-color: #f6f6f6;
    width: 100%;
}
.fn-gantt .navigate {
    border-top: 1px solid #DDD;
    padding: 10px 0 10px 225px;
}

.fn-gantt .navigate .nav-slider {
    height: 20px;
    display: inline-block;
}

.fn-gantt .navigate .nav-slider-left, .fn-gantt .navigate .nav-slider-right {
    text-align: center;
    height: 20px;
    display: inline-block;
}

.fn-gantt .navigate .nav-slider-left {
    float: left;
}

.fn-gantt .navigate .nav-slider-right {
    float: right;
}

.fn-gantt .navigate .nav-slider-content {
    text-align: left;
    width: 160px;
    height: 20px;
    display: inline-block;
    margin: 0 10px;
}

.fn-gantt .navigate .nav-slider-bar, .fn-gantt .navigate .nav-slider-button {
    position: absolute;
    display: block;
}

.fn-gantt .navigate .nav-slider-bar {
    width: 155px;
    height: 6px;
    background-color: #838688;
    margin: 8px 0 0 0;
        -webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.6) inset;
        -moz-box-shadow: 0 1px 3px rgba(0,0,0,0.6) inset;
        box-shadow: 0 1px 3px rgba(0,0,0,0.6) inset;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
}

.fn-gantt .navigate .nav-slider-button {
    width: 17px;
    height: 60px;
    background: url(<?php echo $vars['url']; ?>mod/gantt/graphics/slider_handle.png) center center no-repeat;
    left: 0px;
    top: 0px;
    margin: -26px 0 0 0;
    cursor: pointer;
}

.fn-gantt .navigate .page-number {
    display: inline-block;
    font-size: 10px;
    height: 20px;
}

.fn-gantt .navigate .page-number span {
    color: #666666;
    margin: 0 6px;
    height: 20px;
    line-height: 20px;
    display: inline-block;
}

.fn-gantt .navigate a:link, .fn-gantt .navigate a:visited, .fn-gantt .navigate a:active {
    text-decoration: none;
}

.fn-gantt .nav-link {
    margin: 0 3px 0 0;
    display: inline-block;
    width: 20px;
    height: 20px;
    font-size: 0px;
    background: #595959 url(<?php echo $vars['url']; ?>mod/gantt/graphics/icon_sprite.png) !important;
    border: 1px solid #454546;
    cursor: pointer;
    vertical-align: top;
        -webkit-border-radius: 2px;
        -moz-border-radius: 2px;
        border-radius: 2px;
            -webkit-box-shadow: 0 1px 0 rgba(255,255,255,0.1) inset, 0 1px 1px rgba(0,0,0,0.2);
            -moz-box-shadow: 0 1px 0 rgba(255,255,255,0.1) inset, 0 1px 1px rgba(0,0,0,0.2);
            box-shadow: 0 1px 0 rgba(255,255,255,0.1) inset, 0 1px 1px rgba(0,0,0,0.2);
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
}
.fn-gantt .nav-link:active {
    -webkit-box-shadow: 0 1px 1px rgba(0,0,0,0.25) inset, 0 1px 0 #FFF;
    -moz-box-shadow: 0 1px 1px rgba(0,0,0,0.25) inset, 0 1px 0 #FFF;
    box-shadow: 0 1px 1px rgba(0,0,0,0.25) inset, 0 1px 0 #FFF;
}

.fn-gantt .navigate .nav-page-back {
    background-position: 1px 0 !important;
    margin: 0;
}

.fn-gantt .navigate .nav-page-next {
    background-position: 1px -16px !important;
    margin-right: 15px;
}

.fn-gantt .navigate .nav-slider .nav-page-next {
    margin-right: 5px;
}

.fn-gantt .navigate .nav-begin {
    background-position: 1px -112px !important;
}

.fn-gantt .navigate .nav-prev-week {
    background-position: 1px -128px !important;
}

.fn-gantt .navigate .nav-prev-day {
    background-position: 1px -48px !important;
}

.fn-gantt .navigate .nav-next-day {
    background-position: 1px -64px !important;
}

.fn-gantt .navigate .nav-next-week {
    background-position: 1px -160px !important;
}

.fn-gantt .navigate .nav-end {
    background-position: 1px -144px !important;
}

.fn-gantt .navigate .nav-zoomOut {
    background-position: 1px -96px !important;
}

.fn-gantt .navigate .nav-zoomIn {
    background-position: 1px -80px !important;
    margin-left: 15px;
}

.fn-gantt .navigate .nav-now {
    background-position: 1px -32px !important;
}

.fn-gantt .navigate .nav-slider .nav-now {
    margin-right: 5px;
}

.fn-gantt-loader {
    background-image: url(<?php echo $vars['url']; ?>mod/gantt/graphics/loader_bg.png);
    z-index: 30;
}

.fn-gantt-loader-spinner {
    width: 100px;
    height: 20px;
    position: absolute;
    margin-left: 50%;
    margin-top: 50%;
    text-align: center;
}
.fn-gantt-loader-spinner span {
    color: #fff;
    font-size: 12px;
    font-weight: bold;
}

.row:after {
    clear: both;
}

/** pretify.css **/
.com { color: #767e7e; }
.lit { color: #195f91; }
.pun, .opn, .clo { color: #767e7e; }
.fun { color: #dc322f; }
.str, .atv { color: #268bd2; }
.kwd, .tag { color: #195f91; }
.typ, .atn, .dec, .var { color: #CB4B16; }
.pln { color: #767e7e; }
.prettyprint {
  background-color: #fefbf3;
  padding: 15px 15px 15px 30px;
  border: 1px solid rgba(0,0,0,.2);
  -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.1);
     -moz-box-shadow: 0 1px 2px rgba(0,0,0,.1);
          box-shadow: 0 1px 2px rgba(0,0,0,.1);
}

/* Specify class=linenums on a pre to get line numbering */
ol.linenums {
  margin: 0 0 0 40px;
}
/* IE indents via margin-left */
ol.linenums li {
  padding: 0 5px;
  color: rgba(0,0,0,.15);
  line-height: 20px;
  -webkit-border-radius: 2px;
     -moz-border-radius: 2px;
          border-radius: 2px;
}
/* Alternate shading for lines */
li.L1, li.L3, li.L5, li.L7, li.L9 {  }

/*
$base03:    #002b36;
$base02:    #073642;
$base01:    #586e75;
$base00:    #657b83;
$base0:     #839496;
$base1:     #767e7e;
$base2:     #eee8d5;
$base3:     #fdf6e3;
$yellow:    #b58900;
$orange:    #cb4b16;
$red:       #dc322f;
$magenta:   #d33682;
$violet:    #6c71c4;
$blue:      #268bd2;
$cyan:      #2aa198;
$green:     #859900;
*/


/*
#1d1f21 Background
#282a2e Current Line
#373b41 Selection
#c5c8c6 Foreground
#969896 Comment
#cc6666 Red
#de935f Orange
#f0c674 Yellow
#b5bd68 Green
#8abeb7 Aqua
#81a2be Blue
#b294bb Purple
*/


/* DARK THEME */
/* ---------- */

.prettyprint-dark {
  background-color: #1d1f21;
  border: 0;
  padding: 10px;
}
.prettyprint-dark .linenums li {
  color: #444;
}
.prettyprint-dark .linenums li:hover {
  background-color: #282a2e;
}
/* tags in html */
.prettyprint-dark .kwd,
.prettyprint-dark .tag { color: #cc6666; }
/* html attr */
.prettyprint-dark .typ,
.prettyprint-dark .atn,
.prettyprint-dark .dec,
.prettyprint-dark .var { color: #de935f; }
/* html attr values */
.prettyprint-dark .str,
.prettyprint-dark .atv { color: #b5bd68; }


.com { color: purple; }

/* Copyright: Guillermo Rauch <http://devthought.com/> - Distributed under MIT - Keep this message! */

/* TextboxList sample CSS */
ul.holder { margin: 0; border: 1px solid #999; overflow: hidden; height: auto !important; height: 1%; padding: 4px 5px 0; }
*:first-child+html ul.holder { padding-bottom: 2px; } * html ul.holder { padding-bottom: 2px; } /* ie7 and below */
ul.holder li { float: left; list-style-type: none; margin: 0 5px 4px 0; white-space:nowrap;}
ul.holder li.bit-box, ul.holder li.bit-input input { font: 11px "Lucida Grande", "Verdana"; }
ul.holder li.bit-box { -moz-border-radius: 6px; -webkit-border-radius: 6px; border-radius: 6px; border: 1px solid #CAD8F3; background: #DEE7F8; padding: 1px 5px 2px; }
ul.holder li.bit-box-focus { border-color: #598BEC; background: #598BEC; color: #fff; }
ul.holder li.bit-input input { width: auto; overflow:visible; margin: 0; border: 0px; outline: 0; padding: 3px 0px 2px; } /* no left/right padding here please */
ul.holder li.bit-input input.smallinput { width: 20px; }

/* Facebook demo CSS */
ul.holder { margin: 0 !important }
ul.holder li.bit-box, #apple-list ul.holder li.bit-box { padding-right: 15px; position: relative; z-index:1000;}
#apple-list ul.holder li.bit-input { margin: 0; }
#apple-list ul.holder li.bit-input input.smallinput { width: 5px; }
ul.holder li.bit-hover { background: #BBCEF1; border: 1px solid #6D95E0; }
ul.holder li.bit-box-focus { border-color: #598BEC; background: #598BEC; color: #fff; }
ul.holder li.bit-box a.closebutton { position: absolute; right: 4px; top: 5px; display: block; width: 7px; height: 7px; font-size: 1px; background: url('<?php echo $vars['url']; ?>mod/gantt/images/close.gif'); }
ul.holder li.bit-box a.closebutton:hover { background-position: 7px; }
ul.holder li.bit-box-focus a.closebutton, ul.holder li.bit-box-focus a.closebutton:hover { background-position: bottom; }

/* Autocompleter */

.facebook-auto { display: none; position: absolute; background: #eee; z-index:1001;}
.facebook-auto .select_all_items {display: block; float: right;}
.facebook-auto .default { padding: 5px 7px; border: 1px solid #ccc; border-width: 0 1px 1px;font-family:"Lucida Grande","Verdana"; font-size:11px; }
.facebook-auto ul { display: none; margin: 0; padding: 0; overflow: auto; position:absolute; z-index:9999}
.facebook-auto ul li { padding: 5px 12px; z-index: 1000; cursor: pointer; margin: 0; list-style-type: none; border: 1px solid #ccc; border-width: 0 1px 1px; font: 11px "Lucida Grande", "Verdana"; background-color: #eee }
.facebook-auto ul li em { font-weight: bold; font-style: normal; background: #ccc; }
.facebook-auto ul li.auto-focus { background: #4173CC; color: #fff; }
.facebook-auto ul li.auto-focus em { background: none; }
.deleted { background-color:#4173CC !important; color:#ffffff !important;}
.hidden { display:none;}

#demo ul.holder li.bit-input input { padding: 2px 0 1px; border: 1px solid #999; }
.ie6fix {height:1px;width:1px; position:absolute;top:0px;left:0px;z-index:1;}

.bit-box .closebutton {
	background: url('<?php echo $vars['url']; ?>mod/gantt/images/image.png');
	display: block;
    font-size: 1px;
    height: 7px;
    position: absolute;
    right: 4px;
    top: 5px;
    width: 7px;

}

.expandGantt {
	background: #6CF;
    display: block;
    margin: 0 10px;
    text-align: center;
    color: white;
}
.expandGantt:hover {
    color: white;
}
.gantttaskbar {

}
.gantttaskbar li {
	list-style:none;
    float:left;
    margin: 5px 10px;
    padding: 2px 5px;
    border-radius: 5px;
    background: #6CF;
    color: white;
    cursor:pointer;
}
/*** specific css for gantt plugin ***/
#modalMessageWrapper .message {
	display:none;
}
#modalMessageWrapper .success {
    background: #8BE78B;
    margin: 10px;
    padding: 5px;
    color: #063A06;
    font-weight: bold;
	border-radius:5px;
    text-align:center;
    display:none;
}
#modalMessageWrapper .error {
    background: #E78B8B;
    margin: 10px;
    padding: 5px;
    color: #3A0606;
    font-weight: bold;
    border-radius: 5px;
    text-align: center;
    display:none;
}
.ganttpopuplink {
	color:white;
}
.ganttTask .search_listing {
	display:inline-block;
}
.ganttTask .progressbar {
	width:350px;
}
.ganttTask {
margin: 15px;
padding: 10px;
background: #f6f6f6;
width:auto;
display:none;
}
.ganttTask .task div {

}
.ganttTask .task {
	position:relative;
}
.ganttTask .task label {
    color:#414B57 !important;
    padding: 0 5px;
    border-radius: 3px;
    margin: 0 10px 0 0;
}
.ganttTask .taskactions div {
	display:inline-block;
    margin: 2px 10px;
	padding: 2px 5px;
}
.ganttTask .taskactions {
	position: absolute;
	right: 0;
}