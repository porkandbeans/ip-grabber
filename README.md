# ip-grabber

allow me to preface this by saying I'm in no way suggesting this code
should be used for malicious intent. I believe in open source and I
want as many people to see how I write code as possible for employment
opportunities.

I often use an IP grabber to snoop on TF2 scammers who send me
friend requests and want to steal my extremely valuable hats, and I figured
it would be a good exercise to try writing one of these to understand how they
work and what sort of information I can gather about someone by getting them
to click on a dodgy link.

The "IP-grabber" is, to put it simply, just that - it grabs an IP address.
The target clicks on a link expecting it to lead them to a funny meme
or a YouTube video, but behind the scenes, they are clicking on a link to a third-party
site that writes down a lot of information, including:
    -Their IP address
    -What country they live in
    -Browser information
    -other spooky things they probably wouldn't have freely given out to the person sending them the link
    
and after doing all that, it sends the user away (hopefully) completely unaware that any of that happened

-----
USAGE
-----

on an HTTP server you control, in an empty directory (with appropriate restrictions in HTACCESS) create a link to index.php with the spoofed URL in the "url" GET parameter.
example:
myawesomewebsite.com/index.php?url=https://funnymemesforcoolkids.com

the index.php will dump information about the HTTP request in a filed named after the IP address.
