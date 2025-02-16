<?php
$twitter_user = '';
global $post;
$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' );

$query_string = urlencode(get_the_title()) . '&nbsp;' . urlencode(get_permalink());
?>

<a class="dropdown-item" target="_blank" href="https://api.whatsapp.com/send?text=<?php echo ($query_string); ?>">
	<i class="houzez-icon icon-messaging-whatsapp mr-1"></i> <?php esc_html_e('WhatsApp', 'houzez'); ?>
</a>

<a class="dropdown-item" href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()); ?>&amp;media=<?php echo !empty($image[0]) ? urlencode($image[0]) : ''; ?>&amp;description=<?php echo urlencode(get_the_title()); ?>" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;">
    <i class="houzez-icon icon-social-pinterest mr-1"></i> <?php echo esc_html__('Pinterest', 'houzez'); ?>
</a>

<?php
echo '<a class="dropdown-item" href="https://www.facebook.com/sharer.php?u=' . urlencode(get_permalink()) . '&amp;t='.urlencode(get_the_title()).'" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;">
	<i class="houzez-icon icon-social-media-facebook mr-1"></i> '.esc_html__('Facebook', 'houzez').'
</a>
<a class="dropdown-item" href="https://twitter.com/intent/tweet?text=' . urlencode(get_the_title()) . '&url=' .  urlencode(get_permalink()) . '&via=' . urlencode($twitter_user ? $twitter_user : get_bloginfo('name')) .'" onclick="if(!document.getElementById(\'td_social_networks_buttons\')){window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;}">
	<i class="houzez-icon icon-x-logo-twitter-logo-2 mr-1"></i> '.esc_html__('Twitter', 'houzez').'
</a>
<a class="dropdown-item" href="https://www.linkedin.com/shareArticle?mini=true&url='. urlencode( get_permalink() ) .'&title=' . urlencode( get_the_title() ) . '&source='.urlencode( home_url( '/' ) ).'" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;">
	<i class="houzez-icon icon-professional-network-linkedin mr-1"></i> '.esc_html__('Linkedin', 'houzez').'
</a>
<a class="dropdown-item" href="mailto:someone@example.com?Subject='.get_the_title().'&body='. urlencode( get_permalink() ) .'">
	<i class="houzez-icon icon-envelope mr-1"></i>'.esc_html__('Email', 'houzez').'
</a>';
?>
