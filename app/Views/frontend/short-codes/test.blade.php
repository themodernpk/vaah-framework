{{ $testvar }}

<h1>Testing</h1>

{{ wp_enqueue_script( 'jquery-2', plugin_dir_url( __FILE__ ) . '../../assets/common/jquery.js') }}
{{ wp_enqueue_script( 'bootstrap-js',  plugin_dir_url( __FILE__ ) . '../../assets/common/bootstrap.min.js', array('jquery-2') ) }}
{{ wp_enqueue_script( 'nprogress-js',  plugin_dir_url( __FILE__ ) . '../../assets/common/nprogress.js' ) }}

{{ wp_enqueue_script( 'test-js',  plugin_dir_url( __FILE__ ) . '../../assets/js/test.js' ) }}

{{ wp_enqueue_style( 'nprogress-css',  plugin_dir_url( __FILE__ ) . '../../assets/common/nprogress.min.css' ) }}

<script>
    jQuery(document).ready(function () {
       NProgress.start();
    });
</script>
