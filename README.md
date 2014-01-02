COWOA Module for Zen Cart v2.5
============

CHANGELOG
------------
v2.5 - 12/29/2013
<ul><li>Add check to includes/modules/YOUR_TEMPLATE/no_account.php to look 
for an existing guest (COWOA) account with the same email address and update it 
instead of creating a new one. Thus, only one account exists for 
that same email address. If a customer does create a standard account, 
all the past orders fall back to that same user.(dwest)<br></li><li>Additional improvements to onscreen text/labels<br></li><li>Add additional steps arrows</li><li><span style="color:#ff0000;">(This change is ONLY for those upgrading from cv2.4 or older versions of COWOA or converting from older versions of FEC/FEAC) Fixed the duplicate email address/duplicate email send bug. See: </span><a href="http://www.zen-cart.com/showthread.php?59189-My-Checkout-Without-Account-Mod&amp;p=906772#post906772"><span style="color:#ff0000;">http://www.zen-cart.com/showthread.php?59189-My-Checkout-Without-Account-Mod&amp;p=906772#post906772</span></a><span style="color:#ff0000;"> (damiantaylor)</span><br></li></ul>


## This is a development version of COWOA only
#### If you are looking to install the latest version from zencart please visit [this page](http://www.zen-cart.com/downloads.php?do=file&id=1416)

If you need basic installation help, and the included readme does not help you, please visit the [COWOA Support Thread](http://www.zen-cart.com/showthread.php?196995-COWOA-Updated-and-Combined-for-ZC-v1-5-x)

This module lets your customer checkout without having to register an account on your store. (Guest checkout)

It comes with a couple of additional (optional) modifications that let you see who used COWOA to checkout with and let's those customers who used COWOA to still be able to track the Order Status of their order by using the e-mail name they used during checkout and the OrderID number.

Originally written by KGZotU (Joe Schilz)back in February 2007 and has been modified a few times by others.
The additional mods authors are listed in their updated by text file. 
