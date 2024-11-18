<?php

declare(strict_types=1);

namespace App\Helpers;

class Helpers
{
    /**
     * Функция проверяет доступно ли видео по ссылке на youtube
     *
     * @param string $url ссылка на видео
     * @return true|string Ошибку если валидация не прошла
     */
    public function checkYoutubeUrl(string $url): true|string
    {
        $id = $this->extractYoutubeId($url);

        set_error_handler(function () {}, E_WARNING);
        $headers = get_headers('https://www.youtube.com/oembed?format=json&url=http://www.youtube.com/watch?v=' . $id);
        restore_error_handler();

        if (!is_array($headers)) {
            return "Видео по такой ссылке не найдено. Проверьте ссылку на видео";
        }

        $err_flag = strpos($headers[0], '200') ? 200 : 404;

        if ($err_flag !== 200) {
            return "Видео по такой ссылке не найдено. Проверьте ссылку на видео";
        }

        return true;
    }

    /**
     * Возвращает код iframe для вставки youtube видео на страницу
     *
     * @param string $youtubeUrl
     * @return string
     */
    public function embedYoutubeVideo(string $youtubeUrl): string
    {
        $res = "";
        $id = $this->extractYoutubeId($youtubeUrl);

        if ($id) {
            $src = "https://www.youtube.com/embed/" . $id;
            $res = '<iframe width="760" height="400" src="' . $src . '" frameborder="0"></iframe>';
        }

        return $res;
    }

    /**
     * Возвращает img-тег с обложкой видео для вставки на страницу
     *
     * @param string|null $youtubeUrl
     * @return string
     */
    public function embedYoutubeCover(string $youtubeUrl = null): string
    {
        $res = "";
        $id = $this->extractYoutubeId($youtubeUrl);

        if ($id) {
            $src = sprintf("https://img.youtube.com/vi/%s/mqdefault.jpg", $id);
            $res = '<img alt="youtube cover" width="320" height="120" src="' . $src . '" />';
        }

        return $res;
    }

    /**
     * Извлекает из ссылки на youtube видео его уникальный ID
     *
     * @param string $youtubeUrl
     * @return false|array|null
     */
    public function extractYoutubeId(string $youtubeUrl): false|array|null
    {
        $id = false;

        $parts = parse_url($youtubeUrl);

        if ($parts) {
            if ($parts['path'] == '/watch') {
                parse_str($parts['query'], $vars);
                $id = $vars['v'] ?? null;
            } else {
                if ($parts['host'] == 'youtu.be') {
                    $id = substr($parts['path'], 1);
                }
            }
        }

        return $id;
    }
}
