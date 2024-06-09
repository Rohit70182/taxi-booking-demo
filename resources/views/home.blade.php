<!-- @copyright : OzVid Technologies Pvt. Ltd. < www.ozvid.com >
@author     : Shiv Charan Panjeta < shiv@ozvid.com >


All Rights Reserved.
Proprietary and confidential :  All information contained herein is, and remains
the property of OzVid Technologies Pvt. Ltd. and its partners.
Unauthorized copying of this file, via any medium is strictly prohibited. -->
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <title>{{get_seo() ? get_seo()->title : config(app.name)}}</title>
    <!-- Metas -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="{{get_seo() ? get_seo()->description : 'project Description'}}">
    <meta name="keywords" content="{{get_seo() ? get_seo()->keywords : 'project keywords'}}">
    <meta name="author" content="@ozvidtech">
    <!-- Title  -->


</head>

<body>
    <div>Hello</div>
</body>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-{{get_analytics() ? get_analytics()->account : ''}}"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-{{get_analytics() ? get_analytics()->account : ""}}');
</script>

</html>