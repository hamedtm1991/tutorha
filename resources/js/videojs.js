import videojs from "video.js";
import "videojs-hls-quality-selector/node_modules/videojs-contrib-quality-levels";
import videojsqualityselector from "videojs-hls-quality-selector";


document.addEventListener('DOMContentLoaded', function() {
    let player = videojs('player');

    const firstLink = document.querySelector('.videourl').getAttribute("data-url");
    const firstPoster = document.querySelector('.videourl').getAttribute("cover");
    player.poster(firstPoster)
    player.src({src: firstLink, type: 'application/x-mpegURL'})
    player.hlsQualitySelector = videojsqualityselector;
    player.hlsQualitySelector({
        displayCurrentQuality: true,
    });
    player.playbackRates([0.5, 1, 1.5, 2])


    function changeUrl(url, poster)
    {
        player.src({src: url, type: 'application/x-mpegURL'})
        player.poster(poster)
        player.playbackRates([0.5, 1, 1.5, 2])
        window.scrollTo({ top: 0, behavior: 'smooth' })
    }

    document.querySelectorAll(".videourl").forEach(el=> {
        el.addEventListener("click", e => {
            let url = el.getAttribute("data-url")
            let poster = el.getAttribute("cover")
            changeUrl(url, poster)
        })
    })
});




