<?php

namespace Yoast\WP\Free\Tests\Presentations\Indexable_Term_Archive_Presentation;

use Mockery;
use Yoast\WP\Free\Helpers\Taxonomy_Helper;
use Yoast\WP\Free\Presentations\Indexable_Term_Archive_Presentation;
use Yoast\WP\Free\Tests\Mocks\Indexable;
use Yoast\WP\Free\Tests\Presentations\Presentation_Instance_Helpers;
use Yoast\WP\Free\Wrappers\WP_Query_Wrapper;

/**
 * Trait Presentation_Instance_Builder
 */
trait Presentation_Instance_Builder {
	use Presentation_Instance_Helpers;

	/**
	 * @var Indexable
	 */
	protected $indexable;

	/**
	 * @var Indexable_Term_Archive_Presentation|Mockery\MockInterface
	 */
	protected $instance;

	/**
	 * Builds an instance of Indexable_Term_Archive_Presentation.
	 */
	protected $wp_query_wrapper;

	/**
	 * @var Mockery\Mock
	 */
	protected $taxonomy_helper;

	/**
	 * Builds an instance of Indexable_Post_Type_Presentation.
	 */
	protected function setInstance() {
		$this->indexable = new Indexable();

		$this->wp_query_wrapper = Mockery::mock( WP_Query_Wrapper::class );
		$this->taxonomy_helper  = Mockery::mock( Taxonomy_Helper::class );

		$instance = Mockery::mock(
			Indexable_Term_Archive_Presentation::class,
			[
				$this->wp_query_wrapper,
				$this->taxonomy_helper
			]
		)
			->makePartial()
			->shouldAllowMockingProtectedMethods();

		$this->instance = $instance->of( [ 'model' => $this->indexable ] );

		$this->set_instance_helpers( $this->instance );
	}
}
