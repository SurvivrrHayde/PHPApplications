<header class="p-3 mb-3 border-bottom navbar-dark bg-dark">
    <div class="container">
        <div
            class="d-flex flex-wrap align-items-center justify-content-between"
        >
            <a
                href="?command=showHomepage"
                class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none"
            >
                <span class="fs-3 logo">Game Rank</span>
            </a>
            <div class="d-flex flex-wrap align-items-center">
                <ul
                    class="nav col-12 col-lg-auto mb-2 justify-content-center mb-md-0 mr-1"
                >
                    <li>
                        <a
                            href="?command=showHomepage"
                            class="nav-link px-2 link-body-emphasis"
                        >Home</a
                        >
                    </li>
                    <li>
                        <a
                            href="?command=showRankGroup"
                            class="nav-link px-2 link-body-emphasis"
                        >Your Groups</a
                        >
                    </li>
                    <li>
                        <a href="#" class="nav-link px-2 link-body-emphasis"
                        >Join Group</a
                        >
                    </li>
                    <li>
                        <a href="#" class="nav-link px-2 link-body-emphasis"
                        >Create Group</a
                        >
                    </li>
                </ul>

                <form action="?command=search" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" method="post">
                    <input
                        class="form-control"
                        placeholder="Search Games..."
                        aria-label="Search"
                        name="searchText"
                    >
                </form>

                <div class="dropdown text-end">
                    <a
                        href="#"
                        class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                    >
                        <img
                            src="images/mario.png"
                            alt="mdo"
                            width="32"
                            height="32"
                            class="rounded-circle"
                        >
                    </a>
                    <ul class="dropdown-menu text-small">
                        <li><a class="dropdown-item" href="#">Create Group</a></li>
                        <li>
                            <a class="dropdown-item" href="?command=showRankGroup">Your Groups</a>
                        </li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><hr class="dropdown-divider" ></li>
                        <li><a class="dropdown-item" href="?command=logout">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>