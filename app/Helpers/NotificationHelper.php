<?php

namespace App\Helpers;

class NotificationHelper
{
    public static function speechScript()
    {
        // return "
        // <script>
        //     // Speech synthesis untuk notifikasi suara
        //     const speech = new SpeechSynthesisUtterance();
        //     speech.lang = 'id-ID';
        //     speech.rate = 0.7; // Kecepatan berbicara (0.1 to 10)
        //     speech.pitch = 1; // Nada suara (0 to 2)
        //     speech.volume = 1; // Volume (0 to 1)
        //     let isPlaying = false;

        //     // Fungsi untuk memainkan notifikasi suara
        //     function playNotification(text) {
        //         if (!isPlaying) {
        //             isPlaying = true;
        //             speech.text = text;
        //             speechSynthesis.speak(speech);
        //             speech.onend = function() {
        //                 isPlaying = false;
        //             };
        //         }
        //     }
        // </script>
        // ";

        return "
                <script>
                    const speech = new SpeechSynthesisUtterance();
                    speech.lang = 'id-ID';
                    speech.rate = 0.8; 
                    speech.pitch = 1;
                    speech.volume = 1;
                    let isPlaying = false;

                    // Tunggu sampai suara selesai dimuat
                    window.speechSynthesis.onvoiceschanged = () => {
                        // Dapatkan semua suara yang tersedia
                        const voices = window.speechSynthesis.getVoices();

                        // Cari suara wanita dalam bahasa Indonesia
                        const femaleVoice = voices.find(voice => 
                            voice.lang === 'id-ID' && (voice.name.includes('Google') || voice.name.includes('Indonesian'))
                        );

                        // Jika suara wanita ditemukan, gunakan suara itu
                        if (femaleVoice) {
                            speech.voice = femaleVoice;
                        }
                    };
                    
                    // Fungsi untuk memainkan notifikasi suara
                    function playNotification(text) {
                        if (!isPlaying) {
                            isPlaying = true;
                            speech.text = text;
                            window.speechSynthesis.speak(speech);
                            speech.onend = () => {
                                isPlaying = false;
                            };
                        }
                    }
                </script>
        ";
    }
}
