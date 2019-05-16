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
	    //Scripts to enqueue depart from the original instructions (https://medium.com/tensorflow/text-classification-using-tensorflow-js-an-example-of-detecting-offensive-language-in-browser-e2b94e3565ce) and follow https://github.com/tensorflow/tfjs-models/commit/1c79559dc96fe1096310b5b35dc9ede1c681be87

	}


	public function comment_toxicity()
	{
		$options = get_option( 'settingsToxic' );
		$threshold = $options['threshold']/100;
	    if(is_single() && comments_open() && isset($options['toxicdetection']) ) {

			?>
			<script>
               window.onload=function() {
                   var commentForm = document.getElementById('commentform');
                   commentForm.addEventListener('submit', function(event){

                      async function classify(input) {
                           // Load the model. Users optionally pass in a threshold and an array of labels to include.
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
                       const textComment = document.getElementById('comment').value;
                       classify([textComment]).then(result => {
                           if (result) {
                              alert('Your comment has been flagged as toxic and cannot be submitted at this point. This can happen due to a variety of reasons (insults, obscenity, racism,...). Please, edit your comment and try again');
                           }
                           else  {
                               //console.log(commentForm);
                               HTMLFormElement.prototype.submit.call(commentForm)
                               //commentForm.submit(); <- This doesn't work due to https://stackoverflow.com/questions/56106508/submit-comment-form-inside-an-async-await-then-javascript-block-in-wordpress
                           }
                       })
                    })

               }
			</script>
			<?php
		}
	}
}

