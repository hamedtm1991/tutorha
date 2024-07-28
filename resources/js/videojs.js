import videojs from "video.js";
import videojsqualityselector from "videojs-hls-quality-selector";


document.addEventListener('DOMContentLoaded', function() {
    if (document.querySelector('.videourl') !== null) {
        let player = videojs('player');

        const firstLink = document.querySelector('.videourl').getAttribute("data-url");
        const firstPoster = document.querySelector('.videourl').getAttribute("cover");
        const productid = document.querySelector('.videourl').getAttribute("productid");
        const episodeid = document.querySelector('.videourl').getAttribute("episodeid");
        player.poster(firstPoster)
        player.src({src: firstLink, type: 'application/x-mpegURL'})
        player.setAttribute('productid', productid)
        player.setAttribute('episodeid', episodeid)
        player.hlsQualitySelector = videojsqualityselector;
        player.hlsQualitySelector({
            displayCurrentQuality: true,
        });
        player.playbackRates([0.5, 1, 1.5, 2])


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
});




