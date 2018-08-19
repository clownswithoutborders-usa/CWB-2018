<?php
/**
 * Template part for displaying flexible content.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package CWB-USA
 */

?>

<?php

// check if the flexible content field has rows of data
if( have_rows('content') ):

     // loop through the rows of data
    while ( have_rows('content') ) : the_row();

        if( get_row_layout() == 'full_width_section' ): ?>

            <div class="one-column section row">
                
                <?php the_sub_field('content'); ?>
            
            </div>

	

	<?php elseif( get_row_layout() == 'two_column_section' ): ?>

        <div class="two-column section row">
        
            <div class="one-half left small-12 medium-12 large-6 column">    

                <?php the_sub_field('left_column'); ?>

            </div> 
            
            <div class="one-half right small-12 medium-12 large-6 column">

            	<?php the_sub_field('right_column'); ?>

            </div>

        </div>    

    <?php elseif( get_row_layout() == 'three_column_section' ): ?>

        <div class="three-column section row"> 

            <div class="one-third left small-12 medium-4 column">




                        <?php the_sub_field('column_1'); ?>

            </div>
            
            <div class="one-third center small-12 medium-4 column">

   

                        <?php the_sub_field('column_2'); ?>

            </div>
            
            <div class="one-third right small-12 medium-4 column">

                        <?php the_sub_field('column_3'); ?>

            </div>   

        </div><!-- .three-column.section -->


    <?php elseif( get_row_layout() == 'image_full_width' ): ?>

       	<div class="image section">

            <?php 

                $image = get_sub_field('image');
                $size = 'hero'; // 1600 w
                $imagelink = get_sub_field('image_link');
                
                if( $imagelink ) { ?>

                    <div class="hero">
                     <a href="<?php echo $imagelink; ?>"><?php  echo wp_get_attachment_image( $image, $size ); ?></a>
                    </div>

                <?php } 
                else { ?>

                     <div class="hero"><?php  echo wp_get_attachment_image( $image, $size ); ?>
                    </div>

            <?php } ?>

        </div>    

    <?php elseif( get_row_layout() == 'gallery' ): ?>



                                <?php $images = get_sub_field('images');
                                      $title = get_sub_field('gallery_section_title');
if( $images ): ?>

<?php if( $title ) { ?>
<h2 style="font-size: 24px; text-align:center; clear:both;"><?php echo $title; ?></h2>
<?php } ?>

<div class="my-gallery row section" itemscope itemtype="http://schema.org/ImageGallery">


 <div class="row">
<?php foreach( $images as $image ): ?>
    <figure class="item large-3 medium-4 small-2 column" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject" style="<?php echo $image['caption']; ?>">
      <a href="<?php echo $image['sizes']['large']; ?>" itemprop="contentUrl" data-size="<?php echo $image['width'] . 'x' . $image['height']; ?>">
          <img class="grid-sizer" src="<?php echo $image['sizes']['thumbnail']; ?>" itemprop="thumbnail" alt="<?php echo $image['alt']; ?>" />
      </a>
            <figcaption itemprop="caption description">
                <h4><?php echo $image['title']; ?></h4>
                <?php echo apply_filters('the_content', $image['caption']); ?>
                <?php echo apply_filters('the_content', $image['description']); ?>
          </figcaption> 
                                          
    </figure>
<?php endforeach; ?>
  </div>
  </div>
<?php endif; ?>



    <?php endif;

    endwhile;

else :

    // no layouts found

endif;

?>
