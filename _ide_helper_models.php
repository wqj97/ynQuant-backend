<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\News
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $news_time
 * @property array $analysis
 * @property string $classify
 * @property string $url
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comments[] $comments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\NewsViews[] $views
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\News onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\News whereAnalysis($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\News whereClassify($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\News whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\News whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\News whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\News whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\News whereNewsTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\News whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\News whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\News whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\News withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\News withoutTrashed()
 */
	class News extends \Eloquent {}
}

namespace App{
/**
 * App\Knowledge
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property int|null $parent
 * @property int|null $type
 * @property int|null $page
 * @property string|null $difficulty
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comments[] $comments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\KnowledgesPageViewRecord[] $finished
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Knowledge[] $total
 * @property-read \App\KnowledgesPageViewRecord $userPageTag
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\KnowledgeView[] $views
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Knowledge onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Knowledge whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Knowledge whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Knowledge whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Knowledge whereDifficulty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Knowledge whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Knowledge wherePage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Knowledge whereParent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Knowledge whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Knowledge whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Knowledge whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Knowledge withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Knowledge withoutTrashed()
 */
	class Knowledge extends \Eloquent {}
}

namespace App{
/**
 * App\Comments
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $news_id
 * @property int|null $knowledge_id
 * @property string $content
 * @property mixed|null $analysis
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Likes $current_user_liked
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Likes[] $likes
 * @property-read \App\User $user_info
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Comments onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comments whereAnalysis($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comments whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comments whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comments whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comments whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comments whereKnowledgeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comments whereNewsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comments whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comments whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Comments withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Comments withoutTrashed()
 */
	class Comments extends \Eloquent {}
}

namespace App{
/**
 * App\KnowledgesPageViewRecord
 *
 * @property int $id
 * @property int $knowledge_id
 * @property int|null $user_id
 * @property int $page
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\KnowledgesPageViewRecord whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\KnowledgesPageViewRecord whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\KnowledgesPageViewRecord whereKnowledgeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\KnowledgesPageViewRecord wherePage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\KnowledgesPageViewRecord whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\KnowledgesPageViewRecord whereUserId($value)
 */
	class KnowledgesPageViewRecord extends \Eloquent {}
}

namespace App{
/**
 * App\NewsViews
 *
 * @property int $id
 * @property int $news_id
 * @property int|null $user_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NewsViews whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NewsViews whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NewsViews whereNewsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NewsViews whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NewsViews whereUserId($value)
 */
	class NewsViews extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string|null $phone
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $skills
 * @property string|null $head_url
 * @property string|null $remember_token
 * @property string|null $deleted_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereHeadUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereSkills($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App{
/**
 * App\Likes
 *
 * @property int $id
 * @property int $comment_id
 * @property int $user_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Likes whereCommentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Likes whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Likes whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Likes whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Likes whereUserId($value)
 */
	class Likes extends \Eloquent {}
}

namespace App{
/**
 * App\KnowledgeView
 *
 * @property int $id
 * @property int $knowledge_id
 * @property int|null $user_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\KnowledgeView whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\KnowledgeView whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\KnowledgeView whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\KnowledgeView whereKnowledgeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\KnowledgeView whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\KnowledgeView whereUserId($value)
 */
	class KnowledgeView extends \Eloquent {}
}

