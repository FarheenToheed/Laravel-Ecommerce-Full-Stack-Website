<div class="offcanvas offcanvas-end search-drawer" tabindex="-1" id="searchDrawer">

    <div class="search-header">

        <form onsubmit="return false;">

            <input type="text" id="searchDrawerInput" placeholder="Find Your Favourites" autocomplete="off">

            <button type="submit">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>

        </form>

        <button class="btn-close" data-bs-dismiss="offcanvas"></button>

    </div>

    <div class="search-body">

        <div id="searchDefaultBlock">

            <h5>Need some inspiration?</h5>

            <div class="search-products" id="searchInspirationProducts"></div>

        </div>

        <div id="searchResultsBlock" style="display:none;">
            <h5 id="searchResultsHeading"></h5>
            <div class="search-products" id="searchResultsProducts"></div>
        </div>

        <div id="searchLoadingBlock" style="display:none;">
            <p>Searching...</p>
        </div>

    </div>

</div>