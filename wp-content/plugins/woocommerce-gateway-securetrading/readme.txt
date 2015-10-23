=== WOOCOMMERCE SECURETRADING GATEWAY ===
SecureTrading Gateway is a plugin that extends WooCommerce, allowing you to take payments via SecureTrading. The plugin utilizes the the SecureTrading STPP Payment Pages solution.

SecureTrading is one of UK's leading independent payment processors. SecureTrading enable you to accept credit cards, debit cards and other payment methods such as PayPal and Ukash online via the most reliable and secure internet payment gateway.

When the order goes through, the user is taken to SecureTrading to make a secure payment. No SSL certificate is required on your site. After payment the order is confirmed and the user is taken to the thank you page.

If you receive orders via telephone, fax or mail order (also known as MOTO transactions) the SecureTrading Virtual Terminal is the perfect solution. It is also an ideal call centre solution, enabling agents to take payments in call.

To get started with SecureTrading you will need an agreement with SecureTrading and your acquiring bank. More information about how to get online with SecureTrading can be found at http://www.securetrading.com/.



== INSTALLATION	 ==
1. Download and unzip the latest release zip file.
2. If you use the WordPress plugin uploader to install this plugin skip to step 4.
3. Upload the entire plugin directory to your /wp-content/plugins/ directory.
4. Activate the plugin through the 'Plugins' menu in WordPress Administration.
5. Go to WooCommerce Settings --> Payment Gateways and configure your SecureTrading settings.
6. Contact the SecureTrading Support and ask for a STPP redirect form. See instructions below.



== SECURETRADING ACCOUNT SETUP ==

REDIRECT
To get the return and notification process from SecureTrading to work properly, you need to set up a redirect in your SecurTrading account.

Contact the SecureTrading Support and ask for a STPP – redirect form (this can also be downloaded here: http://www.securetrading.com/support/documents/STPP_Redirect_Request_Form.doc). Fill out the form as follows and send it to support@securetrading.com.

*	Sitereference - your Sitereference number
*	URL - http://your-domain.com/?wc-api=WC_Gateway_Securetrading
*	Payment types - the payment types that you have authorized.
*	Fields - transactionreference, orderreference, errorcode, baseamount


PASSWORD
You will also have to contact the SecureTrading Support and notify them that you want to enable the Security password. Provide them with the following field names (in this order):

Site Reference: Your Site Reference
Password: 		Your choosen SecureTrading Password
Fields: 		sitereference, currencyiso3a, mainamount
Algorithm: 		md5