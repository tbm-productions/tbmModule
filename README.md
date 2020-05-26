# tbmModule Version 1.6
> Requires PHP Verison 7.3.6 or Above
> 
> AUTHOR : Ben M CEO / Co-Owner TBM Productions contact@tbmproduction.com
>  DOCS : https://developer.tbmproduction.com/projects/tbmModule/docs
>  
>  COPYRIGHT 2020 TBM Productions
>  LICENSE : https://tbmproduction.com/license

Thanks for downloading tbmModule! Downloading different TBM Projects helps us understand what the community like and don't like. Below is the Documentation for tbmModule, including how configure it and use all of the functions included in this package.

# Getting Started

To start using tbmModule, upload the file **tbmModule.php** to your website using an FTP Client or File Manager. Make sure to upload it where it is most convenient for you to access.

Once you've uploaded the file, you will then need to import it into the page where you want to use tbmModule. The easiest way to do this is by using the PHP require() or include(). 

**IF ACCESSING IN THE SAME DIRECTORY**

If the **tbmModule.php** file is located in the same directory as the page where you want to use it, then your life is a lot easier.  All you have to do is add this short bit of code to the top of the document (inside the **<?php ?>** tags.

<code>require("tbmModule.php");</code>

**IF ACCESSING FROM A SUB-DIRECTORY**

If the **tbmModule.php** file is a sub-directory (A directory within the directory your page is in), then you need to add a little bit more code to import **tbmModule** .

You must first specify that your accessing a file path starting in the current directory by using the PHP <code>\_\_DIR__</code> which automatically adds the current directory path. After that, you must write out the path to the **tbmModule.php** file. For example: <code>require(\_\_DIR__ . "/path/to/tbmModule.php");</code>

**ACCESSING FROM ANOTHER SITE**

If you want to access the **tbmModule.php** from a remote site then use the PHP <code>require()</code> and the full URL to the file. Note that a lot of Hosting Companies **do not allow** remote accessing (Using the PHP <code>require()</code> on remote sites)  

# Creating a new tbmModule

Now that you have successfully imported **tbmModule** into your page, its time to create a new **tbmModule**.

**tbmModule**  will be stored in a [PHP Variable](https://www.w3schools.com/php/php_variables.asp). This variable can be called whatever you want. In these docs we will be using a variable called <code>$tbm</code>. So to create tbmModule, paste the following code into the document **AFTER** the <code>require() or include()</code> statement.  

<code>$tbm = tbmModule();</code>

This creates tbmModule and stores it in a variable ready to use.

# Commands : Syntax

Syntax is incredibly important in PHP. One incorrect capital letter could cause a [Fatal Error](https://www.php.net/manual/en/language.errors.php7.php). 

PHP Classes are based off of the following Syntax:

Variable containing the Class (In this case we're using \$tbm) then a **->** then the function or variable name. 
Example: <code>$tbm->variable; $tbm->function();</code>

Note about **Constant Variables**: Constants are accessed in a different way, not by using the Syntax above. They are access using the scope <code>::</code> 
Example: <code>$tbm::Constant;</code>

# Commands : Function List


|      Function Name         |      Definition                        |
|----------------------------|----------------------------------------|
|	connect(host, user, password, DB Name) 	| Connects to a MySQLi Database		  |
|	globalVar(action, name, contents)				 | Global Varibales that be used across pages |
|	sessionVar(action, name, contents) | Session Variables that be used across pages during an active session. | 
| base64_encrypt(string) | Base64 Encodes a string |
| base64_decrypt(string) | Base64 Decodes a string |
| hex_encrypt(string) | Hex (Base16) Encodes a string |
| hex_decrypt(string) | Hex (Base16) Decodes a string |
| big_encrypt(string) | Big Encodes (Mix of Base64 & Base16) a string |
| big_decrypt(string) | Big Decodes (Mix of Base64 & Base16) a string |
| md5_hash(string) | MD5 Hashes a string |
| sha1_hash(string) | SHA1 Hashes a string |
| throw_error(error) | Throws a PHP Exception |
| checkDnsRecord(domain, type) | Checks a DNS Record |
| getDnsRecord(domain, type) | Gets all DNS Records of Specified Type |
| getIpv6() | Get the user's current IPv6 Address |
| getIpv4() | Get the user's current IPv4 Address |
| getFullIp() | Gets both the users IPv6 & IPv4 Addresses |
| getFileContents(file_path) | Gets the contents of a File

### For more information visit the docs at https://developer.tbmproduction.com/projects/tbmModule/docs
