# youtube_video_class

I coded this class for manage youtube videos easiest on our website.

If you have a question or just want talk with me, you can come on [my Twitter](https://twitter.com/DevIl00110000).

## How to use ?
Start by initialising the class:

``` php
$yt = new youtube_video('https://www.youtube.com/watch?v=FTQbiNvZqaY');
```

### Is_vYT()
It's the only static function.

This function return true if the url is a youtube url. 

Return **true**
``` php
if (youtube_video::Is_vYT('https://www.youtube.com/watch?v=FTQbiNvZqaY')) {
	# code...
}
``` 
Return **false**

``` php
if (youtube_video::Is_vYT('https://www.vimeo.com/watch?v=FTQbiNvZqaY')) {
	# code...
}
``` 
### get_url()
Return your url.
``` php
$yt->get_url();
```
Return **https://www.youtube.com/watch?v=FTQbiNvZqaY**

### get_id()
Return the video id.
``` php
$yt->get_id();
```
Return **FTQbiNvZqaY**

### get_title()
Return the video title.
``` php
$yt->get_title();
```
Return **Toto - Africa (Official Music Video)**

### get_urlChannel()
Return the channel url.
``` php
$yt->get_urlChanel();
```
Return **https://www.youtube.com/user/TotoVEVO**

### get_nameChannel()
Return the channel name.
``` php
$yt->get_nameChanel();
```
Return **TotoVEVO**

### get_Thumbnail ()
Return an array with the video Thumbnail and other images from the video.
``` php
$yt->get_Thumbnail();
```
Return **an array with 8 differents images**
If you write this :
``` php
$yt->get_Thumbnail()[0];
```
Return **https://img.youtube.com/vi/FTQbiNvZqaY/maxresdefault.jpg**
![](https://img.youtube.com/vi/FTQbiNvZqaY/maxresdefault.jpg)

### Iframe()
``` php
$yt->iframe();
```
Return **an iframe of the video**

## Iframe setting

In this class, there is a public variable named **$iframe_param**.

You need to use it for set the iframe.

For example, if you need to change the iframe width, you can do like that :
``` php
$yt->iframe_param["width"] = '160px';
```

There are 12 parameters that you can set and all are commented with their default value.
``` php
public $iframe_param = [
		'width'          => '560px', // width (or indicator css like "%")
		// Default value : 560px
		'height'         => '315px', // height (or indicateur css comme les "%")
		// Default value : 315px
		"rel"            => '1',     // Displays video suggestions (or 0 for don't display)
		// Default value : 1
		"controls"       => '1',     // Shows the controls (or 0 for don't display)
		// Default value : 1
		"showinfo"       => '1',     // Displays information (or 0 for don't display)
		// Default value : 1
		"cookies"        => '1',     // Mode using cookies (or 0 for don't use cookies)
		// Default value : 1
		"autoplay"       => '0',     // The video doesn't start alone (1 to start alone)
		// Default value : 0
		"color"          => 'red',   // Player color (red or white)
		// Default value : red
		"start"          => '0',     // Start the video at 0 seconds (or start at 20 seconds by putting 20)
		// Default value : 0
		"modestbranding" => '0',     // Displays the YouTube logo on the control banner (or 1 to don't display it)
		// Default value : 0
		"fs"             => '1',     // Present the full screen button (or 0 to don't display it)
		// Default value : 1
		"cc_load_policy" => "1"      // Display subtitles, even if the user has disabled them
		// Default value : 1
	];
```
