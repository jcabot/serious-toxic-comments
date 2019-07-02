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
		wp_enqueue_script( 'tf', plugin_dir_url( __FILE__ ) . 'js/tfjs.js', array( 'jquery' ), null, false );
		wp_enqueue_script( 'tfencode', plugin_dir_url( __FILE__ ) . 'js/universal-sentence-encoder.js', array( 'jquery' ), null, false );
		wp_enqueue_script( 'tftox', plugin_dir_url( __FILE__ ) . 'js/toxicity.js', array( 'jquery' ), null, false );

	    //Scripts to enqueue depart from the original instructions (https://medium.com/tensorflow/text-classification-using-tensorflow-js-an-example-of-detecting-offensive-language-in-browser-e2b94e3565ce) and follow https://github.com/tensorflow/tfjs-models/commit/1c79559dc96fe1096310b5b35dc9ede1c681be87
        // Scripts downloaded and locally enqueued. For reference, original remote locations were:
        // https://cdn.jsdelivr.net/npm/@tensorflow/tfjs', https://cdn.jsdelivr.net/npm/@tensorflow-models/universal-sentence-encoder','https://cdn.jsdelivr.net/npm/@tensorflow-models/toxicity'

	}


	public function check_text_toxicity()
    {
	    $this->comment_toxicity();
	    $this->bbpress_toxicity();
	}

	public function comment_toxicity()
	{
		$options = get_option( 'settingsToxic' );
		$threshold = $options['threshold']/100;
		$message = $options['toxicmessage'];
	    if(is_single() && comments_open() && isset($options['toxicdetection']) ) {

			?>
			<script>
               window.onload=function() {
                   var commentForm = document.getElementById('commentform');
                   commentForm.addEventListener('submit', function(event){

                      async function classify(input) {
                          let toxic=false;
                          const model = await toxicity.load(<?php echo $threshold; ?>);
                          const results = await model.classify(input);

                          for (const r of results) {
                           //   alert(r.label.concat(r.results[0].match.toString()));
                              if (r.results[0].match) {
                                 toxic = true;
                                 break;
                             }
                          }
                          return toxic;//  alert(results[0].label.concat(results[0].results[0].match.toString()));
                      }

                       event.preventDefault();
                       try {
                           const textComment = document.getElementById('comment').value;
                           classify([textComment]).then(result => {
                               if (result) {
                                   alert('<?php echo $message; ?>');
                               } else {
                                   //console.log(commentForm);
                                   HTMLFormElement.prototype.submit.call(commentForm)
                                   //commentForm.submit(); <- This doesn't work due to https://stackoverflow.com/questions/56106508/submit-comment-form-inside-an-async-await-then-javascript-block-in-wordpress
                               }
                           })
                       }
                       catch(error)
                       {
                           console.error(error);
                           HTMLFormElement.prototype.submit.call(commentForm)
                       }
                    })

               }
			</script>
			<?php
		}
	}


	public function bbpress_toxicity()
	{
		$options = get_option( 'settingsToxic' );
		$threshold = $options['threshold']/100;
		$message = $options['toxicmessage'];
		if(is_bbpress() && bbp_is_single_topic() && isset($options['toxicdetection']) ) {

			?>
            <script>
                window.onload=function() {
                    var commentForm = document.getElementById('new-post');
                    commentForm.addEventListener('submit', function(event){

                        async function classify(input) {
                            let toxic=false;
                            const model = await toxicity.load(<?php echo $threshold; ?>);
                            const results = await model.classify(input);

                            for (const r of results) {
                                if (r.results[0].match) {
                                    toxic = true;
                                    break;
                                }
                            }
                            return toxic;
                        }

                        event.preventDefault();
                        try {

                            const textComment = document.getElementById('bbp_reply_content').value; //name of the text area with the replu
                            classify([textComment]).then(result => {
                                if (result) {
                                    alert('<?php echo $message; ?>');
                                } else {
                                    HTMLFormElement.prototype.submit.call(commentForm)
                                }
                            })
                        }
                        catch(error)
                        {
                            console.error(error);
                            HTMLFormElement.prototype.submit.call(commentForm)
                       }
                    })

                }
            </script>
			<?php
		}
	}




}

