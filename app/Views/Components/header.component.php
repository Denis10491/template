<header class="container radius shadow">
    <div class="header__content">
        <h3 class="logo">Template</h3>

        <nav>
            <a href="#">Link 1</a>
            <a href="#">Link 2</a>
            <a href="#">Link 3</a>
        </nav>
    </div>
</header>

<style :scope>
    header {
        height: 60px;
        background: var(--second-color);
        margin: 10px;
    }

    .header__content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 100%;
        padding: 0 20px;
        margin: 20px 0;
    }

    .logo {
        text-transform: uppercase;
    }

    a:not(:last-child) {
        margin: 0 8px 0 0;
    }
</style>