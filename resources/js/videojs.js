import videojs from "video.js";
import "videojs-quality-selector-hls";

let isSafari = /constructor/i.test(window.HTMLElement) || (function (p) { return p.toString() === "[object SafariRemoteNotification]"; })(!window['safari'] || (typeof safari !== 'undefined' && window['safari'].pushNotification));
let isIOS = !window.MSStream && /iPad|iPhone|iPod/.test(navigator.userAgent);
let player = videojs('player');

player.on('ended', function() {
    Livewire.dispatchTo('landings.course', 'end', [player.getAttribute('productid'), player.getAttribute('episodeid')])
});

function changeUrl(url, poster, productid, episodeid)
{
    player.poster(poster)
    player.playbackRates([0.5, 1, 1.5, 2])
    player.setAttribute('productid', productid)
    player.setAttribute('episodeid', episodeid)
    if (isSafari || isIOS) {
        var video = document.getElementById('player_html5_api');
        var source = document.createElement('source');
        source.setAttribute('src', url);
        source.setAttribute('type', 'application/x-mpegURL');
        video.appendChild(source);
        player.load()
    } else {
        player.src({src: url, type: 'application/x-mpegURL'})
    }
    window.scrollTo({ top: 0, behavior: 'smooth' })
}

Livewire.hook('element.init', ({ el, component }) => {
    if (el.tagName === 'LI') {
        let url = el.getAttribute("data-url")
        let poster = el.getAttribute("cover")
        let productid = el.getAttribute("productid")
        let episodeid = el.getAttribute("episodeid")
        let first = el.getAttribute("first")

        if (url !== null) {
            el.addEventListener("click", e => {
                changeUrl(url, poster, productid, episodeid)
            })

            if (first === 'active') {
                changeUrl(url, poster, productid, episodeid)
                document.querySelector('picture.vjs-poster').firstChild.style.height = '100%'
            }
        }
    }
})

// player.currentTime(10);
// let previousTime = 10;
// player.on('timeupdate', function() {
//     let currentTime = this.currentTime();
//     if ((currentTime - previousTime) > 5) {
//         previousTime = currentTime;
//         console.log(currentTime);
//     }
// });
