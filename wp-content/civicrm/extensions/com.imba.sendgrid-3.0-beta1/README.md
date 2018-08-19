# com.imba.sendgrid
<h3>SendGrid Event Notification app listener for CiviCRM</h3>

SendGrid is a 3rd party bulk email delivery provider that features an Event Notification app (https://sendgrid.com/docs/API_Reference/Webhooks/event.html) which is included with their service. This functionality was chosen to integrate as a CiviCRM extension because it's easy to configure what notifications you want sent, features basic HTTP authentication, requires just a "responder" or "listener" (this extension) to receive the notifications from SendGrid and add them to the CiviCRM database, and could be developed to be relatively agnostic of a specific organization and distributed to the CiviCRM community.

The email events that SendGrid sends notifications of include: _Processed, Dropped, Deferred, Delivered, Bounced, Opened, Clicked, Unsubscribed From, Marked as Spam, ASM Group Unsubscribe, ASM Group Resubscribe._ While it is safe to select all actions to be reported by the SendGrid Event Notification app, for better performance _Processed, ASM Group Unsubscribe_, and _ASM Group Resubscribe_ should be deselected. They are essentially meaningless and therefore ignored. CiviCRM already counts an email as delivered as soon as the mail is sent, so _Delivered_ is also ignored. _Deferred_ is simply a temporary failure that will be reattempted; this extension does nothing more that record it to the main CiviCRM log, so you may wish to deselect this action as well.If a particular event type (like click-throughs) were not selected to be sent then the extension simply skips processing that event. This way if a Civi site owner wants to have CiviMail process certain events they can.

The extension allows the site admin to select if they would like SendGrid or CiviCRM to process _Open_ and _Click-through_ events, and if tracking should be made optional per mailing. The extension adds a Mail Spam Report template and includes spam reports on the Mail Summary and the Detailed Report for the mailing. The extension also supports authentication with a username and password.

To install add to your CiviCRM Extentions folder, enable, then go to Mailings > SendGrid Configuration to configure settings. The extension will display the HTTP Post URL to configure in your SendGrid Event Notifications App, as well as other server configuration instructions if needed.

This extension implements the following php overrides:

CRM_Mailing_BAO_Mailing || report function only || confirmed updated to 4.6.6
CRM_Mailing_BAO_Query
CRM_Mailing_BAO_TrackableURL
CRM_Mailing_Selector_Event
CRM_Report_Form_Mailing_Detail
CRM_Report_Form_Mailing_Summary
CRM_Contact_Form_Search
