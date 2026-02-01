<?php

namespace GenAIIntegrator\AI;

class Gemini
{

    private string $api_key;
    private string $endpoint;

    public function __construct()
    {
        $this->api_key = get_option('genai_integrator_gemini_api_key', '');
        $this->endpoint = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-3-flash-preview:generateContent';
    }

    public function generate_text(string $prompt): array
    {

        if (empty($this->api_key)) {
            return [
                'success' => false,
                'error' => 'API Key não configurada.',
            ];
        }

        $body = [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $prompt],
                    ],
                ],
            ],
        ];

        $response = wp_remote_post(
            add_query_arg('key', $this->api_key, $this->endpoint),
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'body' => wp_json_encode($body),
                'timeout' => 30,
            ]
        );

        if (is_wp_error($response)) {
            return [
                'success' => false,
                'error' => $response->get_error_message(),
            ];
        }

        $data = json_decode(wp_remote_retrieve_body($response), true);

        return [
            'success' => true,
            'data' => $data,
        ];
    }

}