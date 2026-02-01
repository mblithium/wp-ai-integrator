<?php

namespace GenAIIntegrator\Admin;

class Settings
{

    public function __construct()
    {
        add_action('admin_menu', [$this, 'add_menu']);
        add_action('admin_init', [$this, 'register_settings']);
    }

    public function add_menu(): void
    {
        add_options_page(
            'GenAI Integrator',
            'GenAI Integrator',
            'manage_options',
            'genai-integrator',
            [$this, 'render_page']
        );
    }

    public function register_settings(): void
    {

        register_setting(
            'genai_integrator_settings',
            'genai_integrator_gemini_api_key',
            [
                'type' => 'string',
                'sanitize_callback' => 'sanitize_text_field',
                'default' => '',
            ]
        );

        add_settings_section(
            'genai_integrator_main_section',
            'Configurações da IA',
            '__return_false',
            'genai-integrator'
        );

        add_settings_field(
            'genai_integrator_gemini_api_key',
            'API Keu do Google Gemini',
            [$this, 'render_api_key_field'],
            'genai-integrator',
            'genai_integrator_main_section'
        );

    }


    public function render_page(): void {
        ?>
            <div class="wrap">
                <h1>GenAI Integrator</h1>

                <form method="post" action="options.php">
                    <?php
                    settings_fields('genai_integrator_settings');
                    do_settings_sections('genai-integrator');
                    submit_button();
                    ?>
                </form>
            </div>
            <?php
    }

    public function render_api_key_field(): void
    {
        $value = get_option('genai_integrator_gemini_api_key', '');

        printf(
            '<input type="password" class="regular-text" name="genai_integrator_gemini_api_key" value="%s" />',
            esc_attr($value)
        );
    }


}
