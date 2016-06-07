#VoiceIt PHP wrapper
A Wrapper for using the VoiceIt Rest API.

##Download
You can download the respository and add its contents to your root project folder by cloning or clicking or here [VoiceIt PHP Library](https://github.com/voiceittech/voiceit-php/archive/master.zip)

##Usage
Then initialize a VoiceIt Object like this with your own developer id
```php
require_once("VoiceIt.php");
$myVoiceIt = new VoiceIt("1d6361f81f3047ca8b0c0332ac0fb17d");
```
Finally use all other API Calls as documented on the [VoiceIt API Documentation](https://siv.voiceprintportal.com/getstarted.jsp#apidocs) page.
