<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://wordpress.org/plugins/serious-toxic-comments/
 * @since      1.0.0
 *
 * @package    Serious_Toxic_Comments
 * @subpackage Serious_Toxic_Comments\public
*/

class Serious_Toxic_Comments_Public_Ext extends Serious_Toxic_Comments_Public {

	protected function define_additional_enqueue_scripts(){
		wp_enqueue_script( 'tf', 'https://cdn.jsdelivr.net/npm/@tensorflow/tfjs', array( 'jquery' ), null, false );
		wp_enqueue_script( 'tfencode', 'https://cdn.jsdelivr.net/npm/@tensorflow-models/universal-sentence-encoder', array( 'jquery' ), null, false );
		wp_enqueue_script( 'tftox', 'https://cdn.jsdelivr.net/npm/@tensorflow-models/toxicity', array( 'jquery' ), null, false );
	}


	public function comment_toxicity()
	{
		$options = get_option( 'discussion' );
	    if(is_single() && comments_open() && isset($options['toxicdetection']) ) {

			?>

			<script>
                //var ctx = document.getElementById("myChart").getContext('2d');
                alert("Hola ! I am an alert box!!");

                window.onload=function() {
                    document.getElementById('commentform').onsubmit=function() {
                        /* do what you want with the form */
                        const textComment = document.getElementById('comment').value;

                        // Should be triggered on form submit
                      //  alert( textComment.concat(' submitted') );
                        // You must return false to prevent the default form behavior

                        const threshold = 0.9;// The minimum prediction confidence.
                        // Load the model. Users optionally pass in a threshold and an array of labels to include.


                        let model, labels;

                        const classify = async (input) => {
                            model = await toxicity.load(<?php echo $options['threshold']; ?>);
                            const results = await model.classify(input);
                            alert(results[0].label.concat(results[0].results[0].match.toString()));
                            alert(results[1].label.concat(results[1].results[0].match.toString()));
                        }

                           // results.forEach((classification) => {
                            //        obj[classification.label] = classification.results[i].match;
                             //   });
                              //  return obj;
                            //});
                        //};

                        classify([textComment]);

                        return false;
                    }
                }

			</script>
			<?php
		}
	}
}

