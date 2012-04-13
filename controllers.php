<?php

function render_content($params) {
    global $ROOT;
    $c = "This site is under construction... content coming soon!";
    if (sizeof($params) == 0) {
        require_once($ROOT.'main.php');
        return;
    }
    else {
        switch($params[0]) {
        case "news":
            if (sizeof($params) == 1) {
                require_once($ROOT."news/news.php");
            }
            else if ($params[1] == "newsletter") {
                require_once($ROOT."news/newsletter/newsletter.php");
            }
			else if ($params[1] == "schedule") {
				require_once($ROOT."news/schedule/schedule.php");
			}
            else {
                echo "That content could not be found.";
            }
            break;
        case "media":
            if (sizeof($params) <= 1) {
                require_once($ROOT."media/media.php");
                return;
            }
            switch($params[1]){
                case "links":
                    require_once($ROOT."media/links/links.php");
                    break;
                case "zipstips":
                    require_once($ROOT."media/zipstips/zipstips.php");
                    break;
                case "photos":
                    require_once($ROOT."media/photos/photos.php");
                    break;
                default:
                    echo "That content could not be found.";
                    break;
            }
            break;
        case "about":
            if (sizeof($params) == 1) {
                require_once($ROOT."about/about.php");
                return;
            }
            else {
                switch($params[1]) {
                    case "roster":
                        $profilename = NULL;
                        if (sizeof($params) >= 3) {
                            $profilename = $params[2];
                        }
                        require_once($ROOT."about/roster/roster.php");
                        break;
                    case "webmasters":
                        require_once($ROOT."about/webmasters/webmasters.php");
                        break;
                    default:
                        echo "That content could not be found.";
                        break;
                }
            }
            break;
        case "support":
            if (sizeof($params) <= 1) {
                require_once($ROOT."support/support.php");
                return;
            }
            else {
                switch($params[1]){
                    case "donate":
                        require_once($ROOT."support/donate/donate.php");
                        break;
                    case "merchandise":
                        require_once($ROOT."support/merchandise/merchandise.php");
                        break;
                }
            }
            break;
        case "history":
            echo $c;
            break;
        default:
            echo "That content could not be found.";
            break;
        }
    }
}

?>