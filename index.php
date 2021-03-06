<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>

<link rel="stylesheet" media="screen" href="http://joeyvo.me/css/1140.css" />
<link rel="stylesheet" media="screen" href="http://joeyvo.me/stylesheet.css" />

<style type="text/css">
	header { margin-top: 50px; }
	a, a:visited { color: #07c; }
	footer { 
		text-align: center;
		font-size: .8em;
		color: #666;
		padding: 50px 0px;
		font-weight: 300;
	}
	iframe { 
		border: 1px solid #f4f4f4; 
		-webkit-box-sizing: border-box; 
		-moz-box-sizing: border-box; 
		box-sizing: border-box;
	}
	h3 { margin-top: 20px; margin-bottom: 10px; }
	p { font-size: .9em; }
	pre {
		background: #eee;
		padding: 5px;
		font-size: .8em;
		margin-bottom: 20px;
	}
	.log_link, .log_link:visited {
		display: block;
		color: #07c;
		font-size: .7em;
		font-weight: 300;
	}
	.git, .git:visited {
		line-height: 60px;
		color: #aaa;
		font-weight: 300;
		text-decoration: none;	
	}
	.git img {
		float: left;
		margin-right: 10px;
		margin-top: 5px;
	}
</style>

</head>

<?php
	
	include('src/class.log.php');
	$log = new Log('example.log');
	$log->clearLog();
	
	$log->entry('** example.log file used for demonstration **', false);
	$log->entry('Basic usage');
	$log->entry('Entry with meta data', array('Your IP', $_SERVER['REMOTE_ADDR']));
	$log->entry('Entry with meta, without timestamp', array('5678', 'Label'), false);
	
	$log->__destruct();
	
	$new_log = new Log(array('default' =>'example.log', 'secondary' => 'example_two.log'));
	
	$new_log->entry(' ', false);
	$new_log->entry('** New log instance, using array **', false);
	$new_log->entry('New entry');
	
?>

<body>
	<a href="https://github.com/Joeynoh/PHP-Log-Class"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://s3.amazonaws.com/github/ribbons/forkme_right_darkblue_121621.png" alt="Fork me on GitHub"></a>

	<div class="container">
  	<div class="row">
      <header class="twelvecol last">
      	<h1>PHP Log Class</h1>
      </header>
    </div>
    
    <div class="row">
      <section class="twelvecol last">
        <iframe src="example.log" width="100%" height="100%"></iframe>
        <a class="log_link" href="example.log" title="Log example">Example log file located here</a>
      </section>
    </div>
    
    <div class="row">
    	<section class="sixcol">
      	<h3>About</h3>
      	<p>This PHP class was written as a light weight, easy-to-use way to log activity to a .log file. It's designed to instantly work within any PHP project, multiple log files and complete freedom with the format of the log entries.</p>
        
        <p>Upon refreshing this page, the example log file in the above iframe is cleared and updated with new entries.</p>
        
        <h3>License</h3>
        <p>MIT/GPL License</p>
        
        <h3>Follow or Fork</h3>
        <a href="https://github.com/Joeynoh/PHP-Log-Class" class="git">
					<img src="http://joeyvo.me/HTML5-minesweeper/images/git.jpg" width="48" height="48" alt="Open Source PHP Log class">
					Follow this project on Github!
				</a>
      </section>
      <section class="sixcol last">
      	<h3>Basic Usage</h3>
        <p>Create a log instance for one .log file, or multiple:</p>
        <pre><code>$log = new Log('example.log');

// OR
        
$multi_logs = new Log(array(
   'default' => 'example.log', 
   'other' => 'other.log'
));</code></pre>

        <p>Add entries to a .log file:</p>
        <pre><code>$log->entry('Basic entry, with timestamp');
        
$log->entry('Entry with meta', array('Meta', 'data', 'here'));   

$log->entry('Entry without timestamp', false);</code></pre>
        
        <p>Clear the .log file completely (use with caution).</p>
        <pre><code>$log->clearLog();</code></pre>
      </section>
    </div>
    
    <div class="row">
    	<footer class="twelvecol last">
      	by Joey van Ommen - <a href="http://joeyvo.me" title="Joey van Ommen's showcase">joeyvo.me</a> - &copy;2013
      </footer>
    </div>
  </div>

</body>
</html>
