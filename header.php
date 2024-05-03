<!-- styles for the entire app -->
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        padding: 0;
        margin: 0;
    }

    table {
        border-spacing: 0;
        border-collapse: collapse;
        text-align: left;
    }
    table td, table th {
        padding-left: 10px;
        padding-right: 10px;
        padding-top: 5px;
        padding-bottom: 5px;
    }
    tr.detail-row:hover {
        background: lightgray;
    }

    .title-bar {
        background: navy;
        width: 100%;
        height: 50px;
        padding-top: 10px;
    }

    .title {
        color: white;
        font-size: 18pt;
        padding: 5px;
        margin-left: 5px;
    }

    .page-link {
        color: white;
        font-size: 15pt;
        padding: 5px;
        border-radius: 6px;
        text-decoration: none;
    }
    .page-link.logout {
        margin-left: 20px;
        color: #D0D0D0;
    }

    .page-link:hover {
        background: lightskyblue;
    }

    .app-body {
        width: 100%;
        margin: 8px;
    }
</style>

<div class="title-bar">
    <span class="title">Quotes Daily</span>
    <a href="./salesAssociate.php" class="page-link">Quotes</a>
    <a href="./Admin2.php" class="page-link">Sales Associates</a>
    <a href="./orders.php" class="page-link">Orders</a>
    <a href="./customerDB.php" class="page-link">Customers</a>
    <a href="./login.php" class="page-link logout">Log Out</a>
</div>
<div class="app-body">