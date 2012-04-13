<?php
    $str = $_SERVER['HTTP_HOST'];
    $test = 'brown.edu';
    if (substr( $str, -strlen( $test ) ) == $test) {
        $ROOT = "/www/data/httpd/htdocs/Athletics/Mens_Ultimate/";
    }
    else {
        $ROOT = "C:/xampp/htdocs/Athletics/Mens_Ultimate/";
    }
    $_SESSION['posts_start'] = 0;
    $number_of_posts = 5; //5 posts will load at a time
    $_SESSION['posts_start'] = $_SESSION['posts_start'] ? $_SESSION['posts_start'] : $number_of_posts; //where we should start
    
    function loadPosts($start = 0, $numPosts = 5) {
        try {
            global $ROOT;
            $db = new PDO('sqlite:'.$ROOT.'admin/database.db');
            $posts = array();
            $result = $db->query("select strftime('%m/%d/%Y', date, 'unixepoch') as post_date,
                                 post as post_content from posts order by date desc limit $start, $numPosts;", PDO::FETCH_ASSOC);
            foreach($result as $row) {
                $posts[] = $row;
            }
            $db = NULL;
            return json_encode($posts);
        }
        catch (PDOException $e) {
            echo "Error Connecting to Database::: " . $e->getMessage() . 'root= '.$ROOT;
        }
    }
?>