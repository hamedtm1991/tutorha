import videojs from "video.js";
import "videojs-quality-selector-hls";

document.addEventListener('DOMContentLoaded', function() {
    var isSafari = /constructor/i.test(window.HTMLElement) || (function (p) { return p.toString() === "[object SafariRemoteNotification]"; })(!window['safari'] || (typeof safari !== 'undefined' && window['safari'].pushNotification));
    var isIOS = !window.MSStream && /iPad|iPhone|iPod/.test(navigator.userAgent);

    if (document.querySelector('.videourl') !== null) {
        if (isSafari || isIOS) {
            var video = document.getElementById('player');
            var source = document.createElement('source');
            const firstLink = document.querySelector('.videourl').getAttribute("data-url");
            source.setAttribute('src', firstLink);
            source.setAttribute('type', 'application/x-mpegURL');
            video.appendChild(source);



            window.addEventListener('load', function () {
                let player = videojs('player');
                const firstPoster = document.querySelector('.videourl').getAttribute("cover");
                const productid = document.querySelector('.videourl').getAttribute("productid");
                const episodeid = document.querySelector('.videourl').getAttribute("episodeid");
                player.poster(firstPoster)
                player.setAttribute('productid', productid)
                player.setAttribute('episodeid', episodeid)
                player.qualitySelectorHls({
                    displayCurrentQuality: true,
                });
                player.playbackRates([0.5, 1, 1.5, 2])
                function changeUrl(url, poster, productid, episodeid)
                {
                    source.setAttribute('src', url);
                    player.poster(poster)
                    player.playbackRates([0.5, 1, 1.5, 2])
                    player.setAttribute('productid', productid)
                    player.setAttribute('episodeid', episodeid)
                    player.load()
                    console.log({
                        src: source.getAttribute('src'),
                        type: source.getAttribute('type'),
                    }, player.currentSrc());
                    window.scrollTo({ top: 0, behavior: 'smooth' })
                }


                player.on('ended', function() {
                    Livewire.dispatchTo('landings.course', 'end', [player.getAttribute('productid'), player.getAttribute('episodeid')])
                });

                // player.currentTime(10);


                // let previousTime = 10;
                // player.on('timeupdate', function() {
                //     let currentTime = this.currentTime();
                //     if ((currentTime - previousTime) > 5) {
                //         previousTime = currentTime;
                //         console.log(currentTime);
                //     }
                // });

                document.querySelectorAll(".videourl").forEach(el=> {
                    el.addEventListener("click", e => {
                        let url = el.getAttribute("data-url")
                        let poster = el.getAttribute("cover")
                        let productid = el.getAttribute("productid")
                        let episodeid = el.getAttribute("episodeid")
                        changeUrl(url, poster, productid, episodeid)
                    })
                })
            })
        } else {

            let player = videojs('player');
            const firstLink = document.querySelector('.videourl').getAttribute("data-url");
            const firstPoster = document.querySelector('.videourl').getAttribute("cover");
            const productid = document.querySelector('.videourl').getAttribute("productid");
            const episodeid = document.querySelector('.videourl').getAttribute("episodeid");
            player.poster(firstPoster)
            player.setAttribute('productid', productid)
            player.setAttribute('episodeid', episodeid)
            player.qualitySelectorHls({
                displayCurrentQuality: true,
            });
            player.playbackRates([0.5, 1, 1.5, 2])
            player.src({src: firstLink, type: 'application/x-mpegURL'})

            function changeUrl(url, poster, productid, episodeid)
            {
                player.src({src: url, type: 'application/x-mpegURL'})
                player.poster(poster)
                player.playbackRates([0.5, 1, 1.5, 2])
                player.setAttribute('productid', productid)
                player.setAttribute('episodeid', episodeid)
                window.scrollTo({ top: 0, behavior: 'smooth' })
            }


            player.on('ended', function() {
                Livewire.dispatchTo('landings.course', 'end', [player.getAttribute('productid'), player.getAttribute('episodeid')])
            });

            // player.currentTime(10);


            // let previousTime = 10;
            // player.on('timeupdate', function() {
            //     let currentTime = this.currentTime();
            //     if ((currentTime - previousTime) > 5) {
            //         previousTime = currentTime;
            //         console.log(currentTime);
            //     }
            // });

            document.querySelectorAll(".videourl").forEach(el=> {
                el.addEventListener("click", e => {
                    let url = el.getAttribute("data-url")
                    let poster = el.getAttribute("cover")
                    let productid = el.getAttribute("productid")
                    let episodeid = el.getAttribute("episodeid")
                    changeUrl(url, poster, productid, episodeid)
                })
            })
        }
    }
});
