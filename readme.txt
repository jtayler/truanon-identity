=== TruAnon Identity ===

Author:            jtayler
Contributors:      jtayler, worldweb
Plugin Name:       TruAnon Identity
Plugin URI:        https://truanon.com/about
Tags:              identity, trust, spam, fraud, safety, social, badge, verify, confirm
Author URI:        https://truanon.com/about
Requires at least: 5.0
Requires PHP:      5.6
Tested up to:      6.0
Stable tag:        1.5
License:           GPLv2 or later
License URI:       https://www.gnu.org/licenses/gpl-2.0.html
Version:           2.0

A simple profile badge that creates a trusted environment by letting members visibly back their own claim of identity.

== Description ==

TruAnon Digital Identity "badge-of-trust" Plugin

A simple way to create a trusted ecosystem on social community sites or anywhere trust and accountability are valued.

NOTE: Before installing this plugin, check with your preferred social profile plugin to be certain TruAnon is not already seamlessly integrated.

TruAnon offers your members safety, privacy and respect:

1. The Right to Privacy
	Assert legitimacy without requirement to reveal personally identifying or private information
2. The Right to Self Identify
	Genuine identity free from ID cards, review or approval from authority
3. The Right to Self-Ownership
	Respectful separation of identity out from profiles and accounts to ensure owner control

TruAnon creates the trusted ecosystem legitimate members crave.

== Installation ==

TruAnon Identity Plugin requires API keys. If you do not yet have API keys specific to your service, please contact TruAnon and we will get you started.

<a href="mailto:hello@truanon.com?subject=TruAnon API Keys Question">ask us</a>

(click or email: hello@truanon.com and tell us about your service)

TruAnon requires a URL Path (like Twitter) that includes your unique member name, and this name should never be changed.

TruAnon Identity Plugin uses a shortcode. You can place this shortcode in whatever profile template or plugin you are using.

<code>
[#truanon_verification userid='user_identifier' username='pretty_username'#]
</code>

TruAnon Identity Plugin shortcode is often placed at the end of each member's own full name, or in a profile area reserved for merit badges.

TruAnon Identity Plugin shortcode typically requires a snippet of code in your Functions.php file. This PHP function stuffs the shortcode into your page and responds dynamically to set your own unique membername. The following example assigns the current profile's unique membername to the userid argument of the shortcode.

If your Social Plugin is UsersWP, you might add an action and push your username as follows:

<code>
add_action( 'uwp_profile_after_title', 'uwp_profile_after_title' );
function uwp_profile_after_title( $user_id ) {
	$user = get_userdata( $user_id );
	$username = $user->user_nicename;
	echo do_shortcode( '[truanon_verification userid='.$user_id.' username='.$username.']' );
}
</code>

Another example might be a theme using Buddy Press Social Plugin as follows:

<code>
add_action( 'bimber_buddypress_memebers_after_user_name', 'bimber_buddypress_memebers_after_user_name' );
function bimber_buddypress_memebers_after_user_name( $user_id ) {
	$user_id = bp_displayed_user_id();
	$user_name =  bp_core_get_username( $user_id );
    echo do_shortcode( '[truanon_verification username='.$user_name.' userid ='.$user_id.']' );
}
</code>

In each case, you'll need to identify the username you'll want to use in your URL Path and ensure there is a unique membername the plugin can use to identify your members.

<img src="/assets/screenshot-1.png" alt="Confirmation and member URL Path Diagram" />

In this way, the shortcode automatically displays for the correct user and is displayed wherever you want.

== Screenshots ==

1. Members assert their own legitimacy without requirement to reveal or transfer any private information. This ensures a safe, trusted ecosystem for your community.
2. Ensure the URL Path to your member profile is the same unique username as given to the shortcode and plugin. You'll note the following image as a visual guide.

== Changelog ==

= 1.0 =
* This is the initial release of TruAnon Identity Plugin.

= 1.1 =
* This Update include bug fixed not neccesary ajax call, Avoid Popup Blockers, reset cofuse text in setting.

= 1.2 =
* This Update fixes edge-case confirmation requirements and improves reliability.

= 1.3 =
* This Update provides all-new settings and improved user experience.

= 1.4 =
* Fixes updates and improvements.

= 1.5 =
* Highly Refined Confirmation Experience.

= 1.5.1 =
* Fixes to interface.

= 1.6 =
* Compatability update, interface updates.

= 1.7 =
* UX updates.

= 2.0 =
* Major release update with better badges and better user-experience.

== Frequently Asked Questions ==

= Does This Prevent Spammers and Masqerading? =

Yes, You cannot impersonate or masquerade using TruAnon. You cannot make multiple accounts because properties you confirm have only one owner.

= Is TruAnon a GDPR Compliant Solution? =

Yes, TruAnon does not rely on private information leaving your service free from liability.

= Do Members Have The Right to Privacy? =

Yes, TruAnon lets any member assert legitimacy without requirement to reveal or transfer any private information.

= Do Members Have The Right to Self Identify? =

Yes, Members confirm their own badge providing genuine identity free from ID cards, review or approval from authority.

= Do Members Have The Right to Self-Ownership? =

Yes, TruAnon respectfully separates identity out of profiles and accounts ensuring owner control and privacy.

= How Long Does Confirmation Take? =

Confirmation is immediate and continuous, it takes just a few minutes before most first-time users are satisfied with their own report.


== Upgrade Notice ==

* This is the initial release of TruAnon Identity Plugin
