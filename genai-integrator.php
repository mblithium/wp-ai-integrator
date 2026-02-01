<?php 
/** 
 * Plugin Name: Gen AI Integrator
 * Description: Integração com IA para gerar textos, imagens e capas.
 * Version: 0.0.1
 * Text Domain: genai-integrator
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

add_action( 'plugin_loaded', function() {
    GenAIIntegrator\Plugin::get_instance();
});