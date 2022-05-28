<?php
defined( 'ABSPATH' ) || exit;

class Mitech_Image {

	public static function get_attachment_info( $attachment_id ) {
		$attachment     = get_post( $attachment_id );
		$attachment_url = wp_get_attachment_url( $attachment_id );

		if ( $attachment === null ) {
			return false;
		}

		$alt = get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true );

		if ( $alt === '' ) {
			$alt = $attachment->post_title;
		}

		return array(
			'alt'         => $alt,
			'caption'     => $attachment->post_excerpt,
			'description' => $attachment->post_content,
			'href'        => get_permalink( $attachment->ID ),
			'src'         => $attachment_url,
			'title'       => $attachment->post_title,
		);
	}

	public static function get_the_post_thumbnail( $args = array() ) {
		if ( isset( $args['post_id'] ) ) {
			$args['id'] = get_post_thumbnail_id( $args['post_id'] );
		} else {
			$args['id'] = get_post_thumbnail_id( get_the_ID() );
		}

		$attachment = self::get_attachment_by_id( $args );

		return $attachment;
	}

	public static function the_post_thumbnail( $args = array() ) {
		$image = self::get_the_post_thumbnail( $args );

		echo "{$image}";
	}

	public static function get_the_post_thumbnail_url( $args = array() ) {
		if ( isset( $args['post_id'] ) ) {
			$args['id'] = get_post_thumbnail_id( $args['post_id'] );
		} else {
			$args['id'] = get_post_thumbnail_id( get_the_ID() );
		}

		$attachment_url = self::get_attachment_url_by_id( $args );

		return $attachment_url;
	}

	public static function the_post_thumbnail_url( $args = array() ) {
		$args['details'] = false;

		$url = self::get_the_post_thumbnail_url( $args );

		echo esc_url( $url );
	}

	public static function get_attachment_by_id( $args = array() ) {
		$defaults = array(
			'id'        => '',
			'size'      => 'full',
			'width'     => '',
			'height'    => '',
			'crop'      => true,
			'class'     => '',
			'details'   => false,
			'lazy_load' => true,
		);

		$args = wp_parse_args( $args, $defaults );

		$image_full = self::get_attachment_info( $args['id'] );

		if ( $image_full === false ) {
			return false;
		}

		$url           = $image_full['src'];
		$cropped_image = self::get_image_cropped_url( $url, $args );

		if ( $cropped_image[0] === '' ) {
			return '';
		}

		$cropped_image_w = isset( $cropped_image[1] ) ? $cropped_image[1] : '';
		$cropped_image_h = isset( $cropped_image[2] ) ? $cropped_image[2] : '';

		if ( '' === $cropped_image_w ) {
			$cropped_image_size = getimagesize( $cropped_image['0'] );

			if ( ! empty( $cropped_image_size ) ) {
				$cropped_image_w = $cropped_image_size[0];
				$cropped_image_h = $cropped_image_size[1];
			}
		}

		// Build img tag.
		$attrs = array();

		$img_classes = array();

		if ( true === $args['lazy_load'] ) {
			$img_classes [] = 'll-image unload';
		}

		if ( ! empty( $args['class'] ) ) {
			$img_classes[] = $args['class'];
		}

		if ( ! empty( $img_classes ) ) {
			$attrs['class'] = implode( ' ', $img_classes );
		}

		if ( ! empty( $args['alt'] ) ) {
			$attrs['alt'] = $args['alt'];
		} else {
			$attrs['alt'] = $image_full['alt'];
		}

		if ( '' !== $cropped_image_w ) {
			$attrs['width'] = $cropped_image_w;
		}

		if ( '' !== $cropped_image_h ) {
			$attrs['height'] = $cropped_image_h;
		}

		// Retina Image.
		$cropped_image_info = pathinfo( $cropped_image['0'] );
		$retina_image       = $cropped_image_info['dirname'] . '/' . $cropped_image_info['filename'] . '@2x.' . $cropped_image_info['extension'];

		if ( self::check_retina_image_exists( $cropped_image_info ) ) {
			$attrs['data-src-retina'] = $retina_image;
		}

		// Tiny image placeholder when lazy load enable.
		if ( true === $args['lazy_load'] ) {
			$placeholder_image_size = self::get_thumbnail_ratio( $cropped_image_w, $cropped_image_h );

			$placeholder_image_url = self::get_image_cropped_url( $url, array(
				'size' => $placeholder_image_size,
				'crop' => true,
			) );

			$attrs['src']      = $placeholder_image_url[0];
			$attrs['data-src'] = $cropped_image[0];
		} else {
			$attrs['src'] = $cropped_image[0];
		}

		$image = self::build_img_tag( $attrs );

		// Wrap img with caption tags.
		if ( isset( $args['caption_enable'] ) && $args['caption_enable'] === true && $image_full['caption'] !== '' ) {
			$before = '<figure>';
			$after  = '<figcaption class="wp-caption-text gallery-caption">' . $image_full['caption'] . '</figcaption></figure>';

			$image = $before . $image . $after;
		}

		if ( $args['details'] === false ) {
			return $image;
		} else {
			// Return image's info for work later.
			$full_details             = $image_full;
			$full_details['template'] = $image;

			return $full_details;
		}

	}

	public static function the_attachment_by_id( $args = array() ) {
		$args ['details'] = false;
		$attachment       = self::get_attachment_by_id( $args );

		echo "{$attachment}";
	}

	public static function get_attachment_url_by_id( $args = array() ) {
		$id = $size = $width = $height = $crop = '';

		$defaults = array(
			'id'      => '',
			'size'    => 'full',
			'width'   => '',
			'height'  => '',
			'crop'    => true,
			'details' => false,
		);

		$args = wp_parse_args( $args, $defaults );
		extract( $args );

		if ( $id === '' ) {
			return '';
		}

		if ( $details === false ) {
			$url           = wp_get_attachment_image_url( $id, 'full' );
			$image_cropped = self::get_image_cropped_url( $url, $args );

			return $image_cropped[0];
		} else {
			$image_full = self::get_attachment_info( $id );
			$url        = $image_full['src'];

			$image_cropped = self::get_image_cropped_url( $url, $args );

			$full_details                  = $image_full;
			$full_details['cropped_image'] = $image_cropped[0];

			return $full_details;
		}
	}

	public static function the_attachment_url_by_id( $args = array() ) {
		$args['details'] = false;

		$url = self::get_attachment_url_by_id( $args );

		echo esc_url( $url );
	}

	/**
	 * @param string $url  Original image url.
	 * @param array  $args Array attributes.
	 *
	 * @return array|bool|string
	 */
	public static function get_image_cropped_url( $url, $args = array() ) {
		extract( $args );

		if ( $url === false ) {
			return array( 0 => '' );
		}

		if ( $size === 'full' ) {
			return array( 0 => $url );
		}

		if ( $size !== 'custom' ) {
			$_sizes = explode( 'x', $size );
			$width  = $_sizes[0];
			$height = $_sizes[1];
		} else {
			if ( $width === '' ) {
				$width = 9999;
			}

			if ( $height === '' ) {
				$height = 9999;
			}
		}

		$width  = (int) $width;
		$height = (int) $height;

		if ( $width === 9999 || $height === 9999 ) {
			$crop = false;
		}

		if ( $width !== '' && $height !== '' && function_exists( 'aq_resize' ) ) {
			$crop_image = aq_resize( $url, $width, $height, $crop, false );

			if ( is_array( $crop_image ) && $crop_image[0] !== '' ) {
				return $crop_image;
			}
		}

		return array( 0 => $url );
	}

	/**
	 * Check if a remote image file exists.
	 * This function become slowly.
	 *
	 * Use this function instead of for better performance.
	 * @see Mitech_Image::check_retina_image_exists()
	 *
	 * @param  string $url The url to the remote image.
	 *
	 * @return bool        Whether the remote image exists.
	 */
	public static function remote_image_file_exists( $url ) {
		$response = wp_remote_head( $url );

		return 200 === wp_remote_retrieve_response_code( $response );
	}

	/**
	 * @param array $cropped_image_info Info of image
	 *
	 * @return bool Whether the image exists.
	 */
	public static function check_retina_image_exists( $cropped_image_info ) {
		$image_dir = explode( 'wp-content/uploads/', $cropped_image_info['dirname'] );
		$sub_dir   = $image_dir[1]; // For eg: 2020/03

		$retina_image_name = $cropped_image_info['filename'] . '@2x.' . $cropped_image_info['extension'];

		$wp_upload = wp_upload_dir();
		$base_url  = $wp_upload['basedir'];

		$retina_image_path = $base_url . DS . $sub_dir . DS . $retina_image_name;

		if ( file_exists( $retina_image_path ) ) {
			return true;
		}

		return false;
	}

	public static function get_thumbnail_ratio( $width, $height, $new_width = 50 ) {
		if ( '' !== $width && '' !== $height ) {
			$ratio = $width / $new_width;

			$new_height = $height / $ratio;
			$new_height = (int) $new_height;

			return "{$new_width}x{$new_height}";
		}

		return "{$new_width}x9999";
	}

	/**
	 * @param array $attributes
	 *
	 * @return string HTML img tag.
	 */
	public static function build_img_tag( $attributes = array() ) {
		if ( empty( $attributes['src'] ) ) {
			return '';
		}

		$attributes_str = '';

		if ( ! empty( $attributes ) ) {
			foreach ( $attributes as $attribute => $value ) {
				$attributes_str .= ' ' . $attribute . '="' . esc_attr( $value ) . '"';
			}
		}

		$image = '<img ' . $attributes_str . ' />';

		return $image;
	}
}
