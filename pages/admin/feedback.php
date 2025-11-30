<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/roast-ms/auth.php';
checkRole(['Administrator']); // Only Administrator can access
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Customer Feedback | ROAST-MS</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="title" content="ROAST-MS" />
  <meta name="author" content="Author" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
    integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg=" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous" />
  <link rel="stylesheet" href="/roast-ms/assets/css/style.css" />
  <link rel="stylesheet" href="/roast-ms/assets/css/adminlte.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
    integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.2/css/buttons.dataTables.min.css">
  <link rel="icon" href="/roast-ms/assets/images/logo.png" type="image/x-icon">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.2.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.2.2/js/buttons.colVis.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.2.2/js/buttons.print.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.2.2/js/buttons.html5.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      new DataTable('#myTable', {
        dom: `<'d-flex justify-content-between mb-3 align-items-center'l<'d-flex align-items-center'<'d-none d-lg-block me-2'>f>>
                rt
                <'d-flex justify-content-between align-items-center mt-3'ip>
                `,
        language: {
          emptyTable: "No data available in table",
        },
        columnDefs: [{
          targets: [0, 1, 2, 3]
        }]
      });
    });
  </script>
</head>

<body class="layout-fixed sidebar-expand-lg sidebar-mini bg-body-tertiary">
  <div class="app-wrapper">
    <nav class="app-header navbar navbar-expand bg-dark" data-bs-theme="dark">
      <div class="container-fluid">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
              <i class="bi bi-list"></i>
            </a>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="#" data-lte-toggle="fullscreen">
              <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
              <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
            </a>
          </li>
          <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
              <img src="/roast-ms/assets/images/default-150x150.png" class="user-image rounded-circle shadow"
                alt="User" />
              <span class="d-none d-md-inline"><?php echo getUsername(); ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
              <li class="user-header text-bg-dark">
                <img src="/roast-ms/assets/images/default-150x150.png" class="rounded-circle shadow" alt="User" />
                <p>
                  <?php echo getFullname(); ?>
                  <small><?php echo getRole(); ?></small>
                </p>
              </li>
          </li>
          <li class="user-footer">
            <a href="/roast-ms/pages/admin/settings" class="btn btn-default btn-flat">Settings</a>
            <a href="/roast-ms/logout" class="btn btn-default btn-flat float-end">Log out</a>
          </li>
        </ul>
        </li>
        </ul>
      </div>
    </nav>
    <aside class="app-sidebar bg-dark shadow" data-bs-theme="dark">
      <div class="sidebar-brand">
        <a href="dashboard.php" class="brand-link">
          <img src="/roast-ms/assets/images/logo.png" alt="Logo" class="brand-image opacity-75 shadow" />
          <span class="brand-text fw-light">ROAST-MS</span>
        </a>
      </div>
      <div class="sidebar-wrapper">
        <div class="user-panel py-2 d-flex align-items-center">
          <div class="image">
            <img width="50" src="/roast-ms/assets/images/default-150x150.png" class="rounded-circle shadow ms-1 me-2"
              alt="User Image">
          </div>
          <div class="info">
            <a
              class="d-block nav-link text-light brand-text text-decoration-none overflow-hidden text-nowrap lh-1 fs-5 fw-bold">WELCOME<br><span
                class="fw-light fs-7"><?php echo getFullname(); ?></span></a>
          </div>
        </div>
        <hr class="text-secondary my-2">
        <nav class="mt-3">
          <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="dashboard.php" class="nav-link">
                <i class="nav-icon bi bi-speedometer"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <li class="nav-header">PAYROLL AND ATTENDANCE</li>
            <li class="nav-item">
              <a href="dtr.php" class="nav-link">
                <i class="nav-icon bi bi-calendar3"></i>
                <p>DTR & Payroll</p>
              </a>
            </li>
            <li class="nav-header">SALES AND ANALYTICS</li>
            <li class="nav-item">
              <a href="salestracking.php" class="nav-link">
                <i class="nav-icon bi bi-clipboard-data"></i>
                <p>Sales Tracking and Forecasting</p>
              </a>
            </li>
            <li class="nav-header">FEEDBACK</li>
            <li class="nav-item">
              <a class="nav-link active">
                <i class="nav-icon bi bi-chat-left-quote"></i>
                <p>Customer Feedback</p>
              </a>
            </li>
            <li class="nav-header">INVENTORY</li>
            <li class="nav-item">
              <a href="inventory.php" class="nav-link">
                <i class="nav-icon bi bi-list-check"></i>
                <p>Inventory Management</p>
              </a>
            </li>
            <li class="nav-header">USERS</li>
            <li class="nav-item">
              <a href="usermanagement.php" class="nav-link">
                <i class="nav-icon bi bi-person-gear"></i>
                <p>User Management</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="audit-trail.php" class="nav-link">
                <i class="nav-icon bi bi-clipboard-pulse"></i>
                <p>Audit Trail</p>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </aside>
    <main class="app-main">
      <div class="app-content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <h3 class="mb-0 fw-bold">Customer Feedback</h3>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Customer Feedback</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="app-content">
        <div class="container-fluid">
          <div class="table-responsive">
            <div class="data_table">
              <?php
              require_once "../../config.php"; // Secure database connection
              $result = $conn->query("SELECT * FROM feedback");

              // Track sentiment counts
              $positiveCount = 0;
              $negativeCount = 0;
              $neutralCount = 0;

              // Track common issues
              $issueCategories = [
                'speed' => ['slow', 'mabagal', 'long wait', 'late', 'delay', 'matagal'],
                'cleanliness' => ['dirty', 'marumi', 'unclean', 'messy', 'not clean', 'hindi malinis'],
                'price' => ['expensive', 'mahal', 'overpriced', 'pricey'],
                'taste' => ['not delicious', 'bland', 'tasteless', 'sour', 'bitter', 'mapait', 'matabang', 'hindi masarap'],
                'service' => ['rude', 'unfriendly', 'pangit na serbisyo', 'bad service', 'hindi maasikaso'],

                // 🆕 Additional categories
                'temperature' => ['hot', 'cold', 'mainit', 'malamig', 'too hot', 'too cold'],
                'availability' => ['unavailable', 'out of stock', 'empty', 'no coffee', 'sold out', 'walang stock'],
                'noise' => ['noisy', 'maingay', 'loud'],
                'comfort' => ['uncomfortable', 'hard chair', 'kulang sa upuan', 'init', 'aircon broken'],
                'portion' => ['small serving', 'too little', 'kulang', 'konti', 'tiny portion'],
                'crowded' => ['crowded', 'full', 'siksikan', 'no space', 'masikip'],
                'wifi' => ['no wifi', 'slow wifi', 'weak wifi', 'walang internet', 'mahina ang wifi'],
                'parking' => ['no parking', 'parking issue', 'walang parking']
              ];

              $issueCount = [
                'speed' => 0,
                'cleanliness' => 0,
                'price' => 0,
                'taste' => 0,
                'service' => 0,
                'temperature' => 0,
                'availability' => 0,
                'noise' => 0,
                'comfort' => 0,
                'portion' => 0,
                'crowded' => 0,
                'wifi' => 0,
                'parking' => 0
              ];

              $positive_words = [
                // General positive
                'good',
                'great',
                'excellent',
                'amazing',
                'awesome',
                'love',
                'fantastic',
                'satisfied',
                'happy',
                'nice',
                'wonderful',
                'perfect',
                'friendly',
                'fast',
                'clean',
                'fresh',
                'delicious',
                'tasty',
                'affordable',
                'cozy',
                'comfortable',
                'quick',
                'beautiful',
                // Coffee shop specific
                'aromatic',
                'flavorful',
                'smooth',
                'strong',
                'rich',
                'freshly brewed',
                'hot',
                'warm',
                'latte',
                'cappuccino',
                'espresso',
                'frappe',
                'mocha',
                'creamy',
                'refreshing',
                'specialty',
                'signature',
                'well-prepared',
                'barista',
                'recommend',
                'relaxing',
                'worth it',
                'attentive',
                'presentable',
                'welcoming',
                'accommodating',
                'helpful',
                'generous',
                'polite',
                'prompt',
                'efficient',
                'value for money',
                'instagrammable',
                // Positive extras
                'pleasant',
                'delightful',
                'superb',
                'enjoyable',
                'instagrammable',
                'worth it',
                'fantastic',
                'cozy',
                'relaxing',
                'efficient',
                'prompt',
                'polite',
                'generous'
              ];

              $negative_words = [
                // General negative
                'bad',
                'poor',
                'terrible',
                'horrible',
                'worst',
                'hate',
                'disappointed',
                'angry',
                'unsatisfied',
                'awful',
                'slow',
                'dirty',
                'rude',
                'expensive',
                'unfriendly',
                'overpriced',
                'crowded',
                'noisy',
                'uncomfortable',
                'ugly',
                'messy',
                // Coffee shop specific
                'burnt',
                'stale',
                'cold',
                'bitter',
                'weak',
                'watery',
                'sour',
                'old coffee',
                'wrong order',
                'unclean',
                'undercooked',
                'overcooked',
                'too sweet',
                'too salty',
                'long wait',
                'late',
                'unavailable',
                'empty',
                'tasteless',
                'bland',
                'not delicious',
                'not fresh',
                'not enough',
                'not good',
                'inconsistent',
                'small serving',
                'delayed',
                'spilled',
                'dirty table',
                'sticky',
                'overbrewed',
                'underbrewed',
                'unhygienic',
                'frustrating',
                'annoying',
                'inconvenient',
                'slow service',
                'overpriced',
                'disappointing',
                'messy table',
                'sticky floor',
                'broken',
                'unhygienic',
                'poor quality',
                'bad taste',
                'overcrowded'
              ];
              // ✅ Tagalog → English Translation Dictionary (same as before)
              function translateTagalogToEnglish($text)
              {

                $lowerText = strtolower($text);
                $lowerText = preg_replace('/hindi\s+(.*?)\s*masarap/', 'not delicious', $lowerText);
                $lowerText = preg_replace('/di\s+(.*?)\s*masarap/', 'not delicious', $lowerText);
                $lowerText = preg_replace('/d\s+(.*?)\s*masarap/', 'not delicious', $lowerText);
                $lowerText = preg_replace('/hindi\s+maganda/', 'not good', $lowerText);
                $lowerText = preg_replace('/di\s+maganda/', 'not good', $lowerText);
                $lowerText = preg_replace('/super\s+(delicious|good|fast|clean)/', '$1', $lowerText);
                $lowerText = preg_replace('/sobrang\s+(delicious|good|fast|clean)/', '$1', $lowerText);
                $lowerText = preg_replace('/grabe\s+(delicious|good|fast|clean)/', '$1', $lowerText);
                $lowerText = preg_replace('/napaka\s+(delicious|good|fast|clean)/', '$1', $lowerText);

                $dictionary = [
                  // Positive
                  'napakasarap' => 'very delicious',
                  'napakaganda' => 'very beautiful',
                  'napakabait' => 'very friendly',
                  'nakakarelax' => 'relaxing',
                  'sulit' => 'worth it',
                  'panalo' => 'excellent',
                  'astig' => 'awesome',
                  'super sarap' => 'very delicious',
                  'sobrang sarap' => 'very delicious',
                  'ang sarap' => 'delicious',
                  'cozy' => 'comfortable',
                  'komportable' => 'comfortable',
                  // Negative
                  'pangit' => 'ugly',
                  'marumi' => 'dirty',
                  'masikip' => 'crowded',
                  'mabagal' => 'slow',
                  'matagal' => 'long wait',
                  'di ok' => 'not good',
                  'nakakainis' => 'annoying',
                  'nakakaasar' => 'annoying',
                  'hassle' => 'inconvenient',
                  'sira' => 'broken',
                  'walang lasa' => 'tasteless',
                  'hilaw' => 'undercooked',
                  'sunog' => 'burnt',
                  'malabnaw' => 'watery',
                  'mapait' => 'bitter',
                  'matabang' => 'bland',
                  'maasim' => 'sour',
                  // Multi-word first
                  'pangit na serbisyo' => 'bad service',
                  'sobrang tamis' => 'too sweet',
                  'hindi masarap' => 'not delicious',
                  'hindi siya masarap' => 'not delicious',
                  'hindi presko' => 'not fresh',
                  'hindi maayos' => 'messy',
                  'hindi malinis' => 'not clean',
                  'hindi maganda' => 'not good',
                  'hindi mabilis' => 'not fast',
                  'mali ang order' => 'wrong order',
                  'walang stock' => 'unavailable',
                  'walang wifi' => 'no wifi',
                  'sobrang mahal' => 'overpriced',
                  'sobrang bagal' => 'very slow',
                  'sobrang ingay' => 'very noisy',

                  // Multi-word & Taglish patterns first
                  'super sarap' => 'very delicious',
                  'sobrang sarap' => 'very delicious',
                  'ang sarap' => 'delicious',
                  'masarap sobra' => 'very delicious',

                  'super mahal' => 'very expensive',
                  'sobrang mahal' => 'very expensive',
                  'medyo mahal' => 'a bit expensive',

                  'super bagal' => 'very slow',
                  'sobrang bagal' => 'very slow',
                  'medyo mabagal' => 'a bit slow',

                  'super ganda' => 'very beautiful',
                  'sobrang ganda' => 'very beautiful',
                  'medyo maganda' => 'quite good',

                  'sobrang ingay' => 'very noisy',
                  'medyo maingay' => 'a bit noisy',

                  'sobrang linis' => 'very clean',
                  'medyo marumi' => 'a bit dirty',

                  'sobrang init' => 'very hot',
                  'sobrang lamig' => 'very cold',
                  'medyo malamig' => 'a bit cold',

                  'konti ang serving' => 'small serving',
                  'kulang sa lasa' => 'not enough taste',
                  'mali ang order' => 'wrong order',
                  'walang stock' => 'unavailable',
                  'walang wifi' => 'no wifi',
                  'sirang aircon' => 'broken aircon',
                  'masikip' => 'crowded',

                  // --- STRONG NEGATIVE PHRASES ---
                  'hindi siya masarap' => 'not delicious',
                  'di siya masarap' => 'not delicious',
                  'di masarap' => 'not delicious',
                  'di ko gusto' => 'i do not like it',
                  'd ko gusto' => 'i do not like it',
                  'hindi ko gusto' => 'i do not like it',
                  'hindi ko nagustuhan' => 'i did not like it',
                  'di ko nagustuhan' => 'i did not like it',
                  'diko nagustuhan' => 'i did not like it',
                  'hindi masarap yung' => 'not delicious',
                  'di masarap yung' => 'not delicious',
                  'hindi ok' => 'not good',
                  'di ok' => 'not good',
                  'diko gusto' => 'i do not like it',

                  // --- STRONG POSITIVE PHRASES ---
                  'ang sarap sobra' => 'very delicious',
                  'grabe ang sarap' => 'very delicious',
                  'grabeng sarap' => 'very delicious',
                  'solid ang sarap' => 'very delicious',
                  'sobrang sarap grabe' => 'very delicious',
                  'ayos na ayos' => 'very good',
                  'panalo sobra' => 'excellent',

                  // --- MODERATE WORDS WITH IMPLIED SENTIMENT ---
                  'pwede na' => 'okay',
                  'ok lang' => 'neutral',
                  'sakto lang' => 'just okay',
                  'medyo masarap' => 'slightly delicious',
                  'medyo hindi masarap' => 'not very delicious',
                  'medyo hindi ok' => 'not good',
                  'medyo hindi maganda' => 'not good',
                  'medyo pangit' => 'a bit ugly',

                  // --- SLANG / TAGLISH COMMON FEEDBACK ---
                  'meh' => 'not good',
                  'low quality' => 'bad',
                  'high quality' => 'great',
                  'not my type' => 'not good',
                  'not worth it' => 'overpriced',
                  'worth the price' => 'worth it',
                  'value for money' => 'worth it',
                  'pricey' => 'expensive',
                  'super slow' => 'very slow',
                  'super rude' => 'very rude',

                  // --- FOOD SPECIFIC NEGATIVE ---
                  'malabnaw' => 'watery',
                  'hilaw' => 'undercooked',
                  'sunog' => 'burnt',
                  'maasim' => 'sour',
                  'malansa' => 'fishy',
                  'mapakla' => 'bitter',
                  'walang lasa' => 'tasteless',

                  // --- AMBIANCE / TOTAL EXPERIENCE ---
                  'pangit ang ambience' => 'bad ambiance',
                  'ganda ng ambience' => 'beautiful ambiance',
                  'ambience' => 'ambiance',
                  'malakas aircon' => 'cold',
                  'mahina aircon' => 'hot',
                  'sira ang aircon' => 'broken aircon',

                  // --- COMMON CUSTOMER COMPLAINTS ---
                  'mabagal ang serbisyo' => 'slow service',
                  'nakakainis' => 'annoying',
                  'nakakaasar' => 'annoying',
                  'nakakadisappoint' => 'disappointing',
                  'hassle' => 'inconvenient',
                  'super hassle' => 'very inconvenient',
                  'ang bagal' => 'slow',
                  'grabeng bagal' => 'very slow',

                  // --- COMMON PRAISE ---
                  'napakabait' => 'very friendly',
                  'napakabilis' => 'very fast',
                  'napakasarap' => 'very delicious',
                  'napakaganda' => 'very beautiful',
                  'napakalinaw' => 'very clean',

                  // Single-word
                  'masarap' => 'delicious',
                  'malasa' => 'flavorful',
                  'maganda' => 'beautiful',
                  'mabait' => 'friendly',
                  'maayos' => 'clean',
                  'malinis' => 'clean',
                  'mura' => 'affordable',
                  'mabilis' => 'fast',
                  'masaya' => 'happy',
                  'magaling' => 'great',
                  'mabango' => 'aromatic',
                  'nakakarelax' => 'relaxing',
                  'komportable' => 'comfortable',
                  'presko' => 'fresh',
                  'sulit' => 'worth it',
                  'panalo' => 'excellent',
                  'maasikaso' => 'attentive',
                  'pangit' => 'ugly',
                  'mahal' => 'expensive',
                  'mabagal' => 'slow',
                  'marumi' => 'dirty',
                  'mainit' => 'hot',
                  'malamig' => 'cold',
                  'mapait' => 'bitter',
                  'matabang' => 'bland',
                  'maingay' => 'noisy',
                  'matagal' => 'long wait',
                  'walang lasa' => 'tasteless',
                  'sobra' => 'too much',
                  'kulang' => 'not enough',
                  'konti' => 'small serving',
                  'sirang aircon' => 'broken aircon',
                  'masikip' => 'crowded',
                  'sarap' => 'delicious',
                  'astig' => 'awesome',
                  'ayos' => 'good',
                  'malupit' => 'amazing'
                ];
                // Replace longer phrases first (to avoid "sarap" catching inside "super sarap")
                uksort($dictionary, function ($a, $b) {
                  return strlen($b) - strlen($a);
                });

                foreach ($dictionary as $tagalog => $english) {
                  $lowerText = str_replace($tagalog, $english, $lowerText);
                }

                return $lowerText;
              }

              // ✅ Sentiment Analysis with Issue Tracking
              function analyzeSentiment(
                $text,
                $rating,
                $positive_words,
                $negative_words,
                &$positiveCount,
                &$negativeCount,
                &$neutralCount,
                &$issueCategories,
                &$issueCount
              ) {
                $text = strtolower($text);
                $commentScore = 0;

                $words = preg_split('/\s+/', $text);

                foreach ($words as $i => $word) {
                  $word = trim($word, ".,!?");
                  $negation = ($i > 0 && in_array($words[$i - 1], ['not', 'never']));

                  if (in_array($word, $positive_words)) {
                    $commentScore += $negation ? -1 : 1;
                  }

                  if (in_array($word, $negative_words)) {
                    $commentScore += $negation ? 1 : -1;

                    foreach ($issueCategories as $category => $keywords) {
                      if (in_array($word, $keywords)) {
                        $issueCount[$category]++;
                      }
                    }
                  }
                }

                // -----------------------------
                // STEP 1: COMMENT-ONLY SENTIMENT
                // -----------------------------
                if ($commentScore > 0) $commentSentiment = "Positive";
                elseif ($commentScore < 0) $commentSentiment = "Negative";
                else $commentSentiment = "Neutral";

                // -----------------------------
                // STEP 2: APPLY RATING WEIGHT
                // -----------------------------
                $rating = (int)$rating;
                if ($rating <= 2) $ratingScore = -5;
                elseif ($rating == 3) $ratingScore = 0;
                else $ratingScore = 5;

                $weightedScore = $ratingScore + $commentScore;

                // -----------------------------
                // STEP 3: INITIAL FINAL SENTIMENT
                // -----------------------------
                if ($weightedScore > 0) $finalSentiment = "Positive";
                elseif ($weightedScore < 0) $finalSentiment = "Negative";
                else $finalSentiment = "Neutral";

                // -----------------------------
                // STEP 4: MISMATCH DETECTION
                // -----------------------------
                $mismatch = false;

                // Positive rating but negative comment  
                if ($rating >= 4 && $commentSentiment == "Negative") {
                  $mismatch = true;
                }

                // Negative rating but positive comment  
                if ($rating <= 2 && $commentSentiment == "Positive") {
                  $mismatch = true;
                }

                // 3-star but extreme written sentiment  
                if ($rating == 3 && abs($commentScore) >= 3) {
                  $mismatch = true;
                }

                // -----------------------------
                // STEP 5: OVERRIDE IF MISMATCH
                // -----------------------------
                if ($mismatch) {
                  // TRUST COMMENT, IGNORE STAR WEIGHT
                  $finalSentiment = $commentSentiment;
                }

                // -----------------------------
                // STEP 6: UPDATE COUNTS
                // -----------------------------
                if ($finalSentiment == "Positive") $positiveCount++;
                elseif ($finalSentiment == "Negative") $negativeCount++;
                else $neutralCount++;

                // -----------------------------
                // STEP 7: RETURN
                // -----------------------------
                return [
                  "badge" =>
                  "<span class='badge bg-" .
                    ($finalSentiment == "Positive" ? "success" : ($finalSentiment == "Negative" ? "danger" : "secondary")) .
                    "'>$finalSentiment</span>",

                  "mismatch" => $mismatch
                ];
              }

              ?>
              <div class="mb-3 d-flex justify-content-end align-items-center gap-2">
                <label for="ratingFilter" class="form-label">Filter:</label>
                <select id="ratingFilter" class="form-select" style="width:150px; border: 1px solid #212529; box-shadow: none;">
                  <option value="" selected disabled hidden>Rating</option>
                  <option value="">All Ratings</option>
                  <option value="★">★</option>
                  <option value="★★">★★</option>
                  <option value="★★★">★★★</option>
                  <option value="★★★★">★★★★</option>
                  <option value="★★★★★">★★★★★</option>
                </select>
              </div>
              <table id="myTable" class="table table-hover table-bordered" style="width:100%">
                <thead>
                  <tr class="fs-6 text-center">
                    <th>Name</th>
                    <th>Email</th>
                    <th>Rating</th>
                    <th>Comment</th>
                    <th>Sentiment</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = $result->fetch_assoc()):
                    $translated_comment = translateTagalogToEnglish($row['comment']);
                    $analysis = analyzeSentiment(
                      $translated_comment,
                      $row['rating'],
                      $positive_words,
                      $negative_words,
                      $positiveCount,
                      $negativeCount,
                      $neutralCount,
                      $issueCategories,
                      $issueCount
                    );
                  ?>
                    <tr class="text-center">
                      <td><?= htmlspecialchars($row['name']) ?></td>
                      <td><?= htmlspecialchars($row['email']) ?></td>
                      <td style="color: #FFD700;"><?= str_repeat('★', $row['rating']) ?></td>
                      <td><?= htmlspecialchars($row['comment']) ?></td>
                      <td><?= $analysis['badge'] ?>
                        <?php if ($analysis['mismatch']): ?>
                          <span class="badge bg-dark text-light">⚠️ Mismatch</span>
                        <?php endif; ?>
                      </td>
                    </tr>
                  <?php endwhile; ?>
                </tbody>
              </table>

              <?php
              if ($result->num_rows > 0) {
                // ✅ Suggestion Section Below Table
                if ($positiveCount > $negativeCount) {
                  echo "<div class='alert alert-success mt-3'><strong>Suggestion:</strong> Customers are mostly happy! Keep maintaining food quality and customer service. 😊</div>";
                } elseif ($negativeCount > $positiveCount) {
                  // Sort issues by frequency
                  arsort($issueCount);

                  $suggestions = [
                    'speed' => "Many customers mentioned waiting time. Suggestion: improve service speed. ⏱️",
                    'cleanliness' => "Cleanliness was a concern. Suggestion: maintain tidiness and hygiene. 🧹",
                    'price' => "Pricing seems to be a concern. Suggestion: review menu pricing or offer promotions. 💰",
                    'taste' => "Some feedback pointed at taste. Suggestion: refine recipes and coffee consistency. ☕",
                    'service' => "Service quality was flagged. Suggestion: train staff for friendliness and attentiveness. 🙋",
                    'temperature' => "Customers mentioned drinks being too hot or too cold. Suggestion: double-check temperature consistency. 🌡️",
                    'availability' => "Some items were unavailable. Suggestion: ensure bestsellers are always in stock. 📦",
                    'noise' => "Noise level was a concern. Suggestion: consider soft music and a cozier environment. 🎶",
                    'comfort' => "Seating comfort was flagged. Suggestion: improve chairs, tables, or air conditioning. 🛋️",
                    'portion' => "Portion sizes were mentioned. Suggestion: review serving sizes to match customer expectations. 🍽️",
                    'crowded' => "Crowded space was noted. Suggestion: improve table arrangements or manage peak hours better. 👥",
                    'wifi' => "Wi-Fi quality was mentioned. Suggestion: provide stable and fast internet for customers. 📶",
                    'parking' => "Parking was an issue. Suggestion: provide clear directions or arrange partnerships with nearby parking areas. 🚗"
                  ];

                  // Pick top 3 issues that have counts > 0
                  $shownSuggestions = [];
                  $counter = 0;
                  foreach ($issueCount as $issue => $count) {
                    if ($count > 0 && isset($suggestions[$issue])) {
                      $shownSuggestions[] = $suggestions[$issue];
                      $counter++;
                    }
                    if ($counter >= 3)
                      break; // limit to 3 suggestions
                  }

                  if (!empty($shownSuggestions)) {
                    echo "<div class='alert alert-danger mt-3'><strong>Suggestions:</strong><ul>";
                    foreach ($shownSuggestions as $s) {
                      echo "<li>$s</li>";
                    }
                    echo "</ul></div>";
                  } else {
                    echo "<div class='alert alert-secondary mt-3'><strong>Suggestion:</strong> Feedback is mixed. Try gathering more insights with surveys. 🤔</div>";
                  }
                } else {
                  echo "<div class='alert alert-secondary mt-3'><strong>Suggestion:</strong> Feedback is mixed. Try gathering more insights with surveys. 🤔</div>";
                }
              } else {
                // ✅ No feedback at all
                echo "<div class='alert alert-secondary mt-3'>No feedback available yet.</div>";
              }
              ?>

            </div>
          </div>
        </div>
      </div>
    </main>
    <footer class="app-footer">
      <div class="float-end d-none d-sm-inline"></div>
      <strong>
        © <span id="year"></span> ROAST-MS Dev. <span class="fw-light">|</span>
      </strong>
      All Rights Reserved.
    </footer>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
    integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>
  <script src="/roast-ms/assets/js/adminlte.js"></script>
  <script>
    const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
    const Default = {
      scrollbarTheme: 'os-theme-light',
      scrollbarAutoHide: 'leave',
      scrollbarClickScroll: true,
    };
    document.addEventListener('DOMContentLoaded', function() {
      const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
      if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
        OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
          scrollbars: {
            theme: Default.scrollbarTheme,
            autoHide: Default.scrollbarAutoHide,
            clickScroll: Default.scrollbarClickScroll,
          },
        });
      }
    });
  </script>
  <script>
    $(document).ready(function() {
      var table = new DataTable('#myTable'); // initialize DataTable

      // Filter by Rating dropdown
      $('#ratingFilter').on('change', function() {
        var value = $(this).val(); // selected value
        if (value) {
          table.column(2).search('^' + value + '$', true, false).draw();
        } else {
          // Show all rows
          table.column(2).search('').draw();
        }
      });
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
    integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script>
  <script src="/roast-ms/assets/js/main.js"></script>
  <script src="/roast-ms/assets/js/script.js"></script>
</body>

</html>