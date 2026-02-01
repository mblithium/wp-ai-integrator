<?php

namespace GenAIIntegrator;

class Plugin {

    private static ?Plugin $instance = null;

    public static function get_instance(): Plugin {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct() {
        $this->init();
    }

    private function init(): void {
        if ( is_admin() ) {
            new Admin\Settings();
        }

        /*add_action( 'admin_init', function () {
            $gemini = new AI\Gemini();
            $result = $gemini->generate_text( 'Escreva um título criativo para um post sobre WordPress e IA.' );

            error_log( print_r( $result, true ) );
        });*/

    }

    
}