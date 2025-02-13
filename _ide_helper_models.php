<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $image
 * @property string $title
 * @property string $main_title
 * @property string $description
 * @property string $video_link
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @method static \Database\Factories\AboutFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|About newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|About newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|About query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|About whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|About whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|About whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|About whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|About whereMainTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|About whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|About whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|About whereVideoLink($value)
 */
	class About extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $delivery_area_id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\DeliveryArea $deliveryArea
 * @property-read \App\Models\TFactory|null $use_factory
 * @method static \Database\Factories\AddressFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereDeliveryAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereUserId($value)
 */
	class Address extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $image
 * @property string $background
 * @property string $title
 * @property string $short_description
 * @property string|null $play_store_link
 * @property string|null $apple_store_link
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppDownloadSection newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppDownloadSection newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppDownloadSection query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppDownloadSection whereAppleStoreLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppDownloadSection whereBackground($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppDownloadSection whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppDownloadSection whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppDownloadSection whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppDownloadSection wherePlayStoreLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppDownloadSection whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppDownloadSection whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppDownloadSection whereUpdatedAt($value)
 */
	class AppDownloadSection extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string $sub_title
 * @property string $url
 * @property string $banner
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @method static \Database\Factories\BannerSliderFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BannerSlider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BannerSlider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BannerSlider query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BannerSlider whereBanner($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BannerSlider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BannerSlider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BannerSlider whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BannerSlider whereSubTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BannerSlider whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BannerSlider whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BannerSlider whereUrl($value)
 */
	class BannerSlider extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $category_id
 * @property string $image
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property string|null $seo_title
 * @property string|null $seo_description
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\BlogCategory $category
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BlogComment> $comments
 * @property-read int|null $comments_count
 * @property-read \App\Models\TFactory|null $use_factory
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\BlogFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog whereSeoDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog whereSeoTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Blog whereUserId($value)
 */
	class Blog extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Blog> $blogs
 * @property-read int|null $blogs_count
 * @property-read \App\Models\TFactory|null $use_factory
 * @method static \Database\Factories\BlogCategoryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogCategory whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogCategory whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogCategory whereUpdatedAt($value)
 */
	class BlogCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $blog_id
 * @property int $user_id
 * @property string $comment
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Blog $blog
 * @property-read \App\Models\TFactory|null $use_factory
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\BlogCommentFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogComment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogComment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogComment query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogComment whereBlogId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogComment whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogComment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogComment whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogComment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BlogComment whereUserId($value)
 */
	class BlogComment extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property bool $status
 * @property bool $show_at_home
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereShowAtHome($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereUpdatedAt($value)
 */
	class Category extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $sender_id
 * @property int $receiver_id
 * @property string $message
 * @property bool $seen
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @property-read \App\Models\User|null $receiver
 * @property-read \App\Models\User|null $sender
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chat query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chat whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chat whereReceiverId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chat whereSeen($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chat whereSenderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chat whereUpdatedAt($value)
 */
	class Chat extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $image
 * @property string $name
 * @property string $title
 * @property string|null $fb
 * @property string|null $in
 * @property string|null $x
 * @property string|null $web
 * @property bool $show_at_home
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @method static \Database\Factories\ChefFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chef newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chef newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chef query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chef whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chef whereFb($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chef whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chef whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chef whereIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chef whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chef whereShowAtHome($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chef whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chef whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chef whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chef whereWeb($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chef whereX($value)
 */
	class Chef extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string|null $phone_one
 * @property string|null $phone_two
 * @property string|null $mail_one
 * @property string|null $mail_two
 * @property string|null $address
 * @property string|null $map_link
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @method static \Database\Factories\ContactFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereMailOne($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereMailTwo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereMapLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact wherePhoneOne($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact wherePhoneTwo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereUpdatedAt($value)
 */
	class Contact extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $background
 * @property string $counter_icon_one
 * @property string $counter_count_one
 * @property string $counter_name_one
 * @property string $counter_icon_two
 * @property string $counter_count_two
 * @property string $counter_name_two
 * @property string $counter_icon_three
 * @property string $counter_count_three
 * @property string $counter_name_three
 * @property string $counter_icon_four
 * @property string $counter_count_four
 * @property string $counter_name_four
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @method static \Database\Factories\CounterFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Counter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Counter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Counter query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Counter whereBackground($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Counter whereCounterCountFour($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Counter whereCounterCountOne($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Counter whereCounterCountThree($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Counter whereCounterCountTwo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Counter whereCounterIconFour($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Counter whereCounterIconOne($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Counter whereCounterIconThree($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Counter whereCounterIconTwo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Counter whereCounterNameFour($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Counter whereCounterNameOne($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Counter whereCounterNameThree($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Counter whereCounterNameTwo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Counter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Counter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Counter whereUpdatedAt($value)
 */
	class Counter extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property int $quantity
 * @property int $min_purchase_amount
 * @property string $expire_date
 * @property string $discount_type
 * @property float $discount
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @method static \Database\Factories\CouponFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupon newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupon newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupon query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupon whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupon whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupon whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupon whereDiscountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupon whereExpireDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupon whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupon whereMinPurchaseAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupon whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupon whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupon whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Coupon whereUpdatedAt($value)
 */
	class Coupon extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $content
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @method static \Database\Factories\CustomPageBuilderFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomPageBuilder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomPageBuilder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomPageBuilder query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomPageBuilder whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomPageBuilder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomPageBuilder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomPageBuilder whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomPageBuilder whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomPageBuilder whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomPageBuilder whereUpdatedAt($value)
 */
	class CustomPageBuilder extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $product_id
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @property-read \App\Models\Product $product
 * @method static \Database\Factories\DailyOfferFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DailyOffer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DailyOffer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DailyOffer query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DailyOffer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DailyOffer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DailyOffer whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DailyOffer whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DailyOffer whereUpdatedAt($value)
 */
	class DailyOffer extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $area_name
 * @property string $min_delivery_time
 * @property string $max_delivery_time
 * @property float $delivery_fee
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @method static \Database\Factories\DeliveryAreaFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryArea newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryArea newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryArea query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryArea whereAreaName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryArea whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryArea whereDeliveryFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryArea whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryArea whereMaxDeliveryTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryArea whereMinDeliveryTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryArea whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeliveryArea whereUpdatedAt($value)
 */
	class DeliveryArea extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string|null $short_info
 * @property string|null $address
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $copyright
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FooterInfo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FooterInfo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FooterInfo query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FooterInfo whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FooterInfo whereCopyright($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FooterInfo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FooterInfo whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FooterInfo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FooterInfo wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FooterInfo whereShortInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FooterInfo whereUpdatedAt($value)
 */
	class FooterInfo extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $option_name
 * @property float $price
 * @property int $product_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @method static \Database\Factories\OptionProductFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OptionProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OptionProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OptionProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OptionProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OptionProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OptionProduct whereOptionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OptionProduct wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OptionProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OptionProduct whereUpdatedAt($value)
 */
	class OptionProduct extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $invoice_id
 * @property int $user_id
 * @property string $address
 * @property float $discount
 * @property float $delivery_charge
 * @property float $subtotal
 * @property float $grand_total
 * @property int $product_qty
 * @property string|null $payment_method
 * @property string $payment_status
 * @property string|null $payment_approve_date
 * @property string|null $transaction_id
 * @property string|null $coupon_info
 * @property string|null $currency_name
 * @property string $order_status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $address_id
 * @property-read \App\Models\DeliveryArea|null $deliveryArea
 * @property-read \App\Models\TFactory|null $use_factory
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\OrderItem> $orderItems
 * @property-read int|null $order_items_count
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Address|null $userAddress
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereAddressId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereCouponInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereCurrencyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereDeliveryCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereGrandTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereInvoiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereOrderStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order wherePaymentApproveDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereProductQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereSubtotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereUserId($value)
 */
	class Order extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $order_id
 * @property string $product_name
 * @property int $product_id
 * @property float $unit_price
 * @property int $qty
 * @property string|null $product_size
 * @property string|null $product_option
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem whereProductName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem whereProductOption($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem whereProductSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem whereUnitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem whereUpdatedAt($value)
 */
	class OrderItem extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $message
 * @property int $order_id
 * @property bool $seen
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderPlacedNotification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderPlacedNotification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderPlacedNotification query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderPlacedNotification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderPlacedNotification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderPlacedNotification whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderPlacedNotification whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderPlacedNotification whereSeen($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderPlacedNotification whereUpdatedAt($value)
 */
	class OrderPlacedNotification extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $key
 * @property string|null $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentGatewaySetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentGatewaySetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentGatewaySetting query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentGatewaySetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentGatewaySetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentGatewaySetting whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentGatewaySetting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentGatewaySetting whereValue($value)
 */
	class PaymentGatewaySetting extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @method static \Database\Factories\PrivacyPolicyFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PrivacyPolicy newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PrivacyPolicy newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PrivacyPolicy query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PrivacyPolicy whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PrivacyPolicy whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PrivacyPolicy whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PrivacyPolicy whereUpdatedAt($value)
 */
	class PrivacyPolicy extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $product_name
 * @property string $slug
 * @property string $product_image
 * @property int $category_id
 * @property string $short_description
 * @property string $long_description
 * @property float $price
 * @property float $offer_price
 * @property string|null $sku
 * @property string|null $seo_title
 * @property string|null $seo_description
 * @property bool $show_at_home
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property float|null $quantity
 * @property-read \App\Models\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProductGallery> $galleryProduct
 * @property-read int|null $gallery_product_count
 * @property-read \App\Models\TFactory|null $use_factory
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\OptionProduct> $optionProduct
 * @property-read int|null $option_product_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Product> $relatedProducts
 * @property-read int|null $related_products_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProductRating> $reviews
 * @property-read int|null $reviews_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProductSize> $sizeProduct
 * @property-read int|null $size_product_count
 * @method static \Database\Factories\ProductFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereLongDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereOfferPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereProductImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereProductName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereSeoDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereSeoTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereShowAtHome($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereSku($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereUpdatedAt($value)
 */
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $product_id
 * @property string $gallery_image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @method static \Database\Factories\ProductGalleryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductGallery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductGallery newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductGallery query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductGallery whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductGallery whereGalleryImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductGallery whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductGallery whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductGallery whereUpdatedAt($value)
 */
	class ProductGallery extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property int $rating
 * @property string $review
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\ProductRatingFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductRating newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductRating newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductRating query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductRating whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductRating whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductRating whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductRating whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductRating whereReview($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductRating whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductRating whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductRating whereUserId($value)
 */
	class ProductRating extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $size_name
 * @property float $price
 * @property int $product_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @method static \Database\Factories\SizeProductFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductSize newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductSize newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductSize query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductSize whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductSize whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductSize wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductSize whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductSize whereSizeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductSize whereUpdatedAt($value)
 */
	class ProductSize extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $reservation_id
 * @property int $user_id
 * @property string $name
 * @property string $phone
 * @property string $date
 * @property string $time
 * @property int $persons
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @method static \Database\Factories\ReservationFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation wherePersons($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereReservationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereUserId($value)
 */
	class Reservation extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $start_time
 * @property string $end_time
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @method static \Database\Factories\ReservationTimeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReservationTime newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReservationTime newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReservationTime query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReservationTime whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReservationTime whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReservationTime whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReservationTime whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReservationTime whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReservationTime whereUpdatedAt($value)
 */
	class ReservationTime extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string|null $key
 * @property string|null $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SectionTitle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SectionTitle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SectionTitle query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SectionTitle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SectionTitle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SectionTitle whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SectionTitle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SectionTitle whereValue($value)
 */
	class SectionTitle extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $key
 * @property string|null $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereValue($value)
 */
	class Setting extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $image
 * @property string|null $offer
 * @property string $title
 * @property string $subtitle
 * @property string $short_description
 * @property string|null $button_link
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @method static \Database\Factories\SliderFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slider query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slider whereButtonLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slider whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slider whereOffer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slider whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slider whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slider whereSubtitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slider whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slider whereUpdatedAt($value)
 */
	class Slider extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $icon
 * @property string $name
 * @property string $link
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @method static \Database\Factories\SocialLinkFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialLink newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialLink newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialLink query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialLink whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialLink whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialLink whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialLink whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialLink whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialLink whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SocialLink whereUpdatedAt($value)
 */
	class SocialLink extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @method static \Database\Factories\SubscriberFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscriber newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscriber newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscriber query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscriber whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscriber whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscriber whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subscriber whereUpdatedAt($value)
 */
	class Subscriber extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TermsConditions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TermsConditions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TermsConditions query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TermsConditions whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TermsConditions whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TermsConditions whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TermsConditions whereUpdatedAt($value)
 */
	class TermsConditions extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $image
 * @property string $name
 * @property string $title
 * @property string $review
 * @property int $rating
 * @property bool $show_at_home
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @method static \Database\Factories\TestimonialFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial whereReview($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial whereShowAtHome($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial whereUpdatedAt($value)
 */
	class Testimonial extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $avatar
 * @property string $name
 * @property string $email
 * @property string $role
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Chat> $chats
 * @property-read int|null $chats_count
 * @property-read \App\Models\TFactory|null $use_factory
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Order> $orders
 * @property-read int|null $orders_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $icon
 * @property string $title
 * @property string $short_description
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @method static \Database\Factories\WhyChooseUsFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WhyChooseUs newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WhyChooseUs newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WhyChooseUs query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WhyChooseUs whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WhyChooseUs whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WhyChooseUs whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WhyChooseUs whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WhyChooseUs whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WhyChooseUs whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WhyChooseUs whereUpdatedAt($value)
 */
	class WhyChooseUs extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @property-read \App\Models\Product $product
 * @method static \Database\Factories\WishlistFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Wishlist newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Wishlist newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Wishlist query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Wishlist whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Wishlist whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Wishlist whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Wishlist whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Wishlist whereUserId($value)
 */
	class Wishlist extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|post query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|post whereUpdatedAt($value)
 */
	class post extends \Eloquent {}
}

