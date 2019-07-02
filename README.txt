=== Serious Toxic Comments ===
Contributors: softmodeling, seriouswp
Tags: comments, toxic, toxicity, AI, tensorflow, insults, offensive, threats, machine learning, bbpress, forum
Requires at least: 4.3
Tested up to: 5.2.2
Requires PHP: 5.6
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Flag and block toxic comments from polluting your site with insults, threats, obscenities, etc.

== Description ==

Toxic comments are becoming a major challenge to have meaningful online discussions.

This plugin uses a pre-trained toxic classifier from [TensorFlow](https://www.tensorflow.org/) to classify a comment as toxic. See more technical details on the quality of the model [here](https://medium.com/tensorflow/text-classification-using-tensorflow-js-an-example-of-detecting-offensive-language-in-browser-e2b94e3565ce).

Once a comment is flagged as toxic, the comment is blocked and the plugin alerts the comment author and asks to modify the text before trying again.

In the default *Settings->Discussion* page you can enable the detection of toxic comments and define the threshold confidence level for the prediction.

== Installation ==

Install and Activate the plugin through the 'Plugins' menu in WordPress


== Frequently Asked Questions ==

= How did you train the predictive model? =

We didn't. We are using a pre-trained model provided by tensorflow itself.

= Can I improve or personalize the prediction by manually training the toxicity classifier on my site? =

No. The classifier is pre-trained. But you could build your own classifier based on the [code to create and train] (https://github.com/conversationai/conversationai-models/tree/master/experiments) this one

= What external JavaScript scripts does the plugin import? =

The plugin relies on tensorflow.js to analyze the comment on the browser. Therefore, the plugin enqueues tensorflow, the sentence encoder and the toxicity model.
Nevertheless, the JS code to execute the actual comment classification is only added to single post pages with comments (and the toxicity settings) enabled.

== Screenshots ==

1. Configuration settings for the plugin
2. Example of a blocked comment

== Changelog ==

= 1.1.1 =
* Bug fix: Avoids calling bbPress functions when bbPress is not present in the site

= 1.1 =
* Added support for bbPress
* Possibility to configure the warning message when a toxic comment is detected

= 1.0 =
* Initial release

== Upgrade Notice ==

= 1.1.1 =
* Bug fix: checks for the existance of bbPress in the site before calling bbPres functions

= 1.1 =
* Added bbPress support and configuration of the alert toxic message