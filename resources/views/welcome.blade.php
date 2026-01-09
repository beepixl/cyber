<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Cyber Crime Police Station - Navsari</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet" />
  <style>
    body {
      font-family: "Poppins", -apple-system, BlinkMacSystemFont, sans-serif;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
    }
    .header {
      background: rgba(255,255,255,0.95);
      backdrop-filter: blur(10px);
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .logo-circle {
      width: 45px;
      height: 45px;
      border-radius: 50%;
      background: linear-gradient(135deg, #667eea, #764ba2);
      display: flex;
      align-items: center;
      justify-content: center;
      color: #ffffff;
      font-weight: 700;
      font-size: 20px;
      box-shadow: 0 4px 15px rgba(102,126,234,0.4);
    }
    .sidebar {
      background: rgba(255,255,255,0.95);
      backdrop-filter: blur(10px);
      border-radius: 16px;
      box-shadow: 0 8px 32px rgba(0,0,0,0.1);
      transition: all 0.3s ease;
    }
    @media (min-width: 992px) {
      .sidebar {
        display: block !important;
      }
      .sidebar.collapse {
        display: block !important;
      }
    }
    @media (max-width: 991.98px) {
      .sidebar {
        margin-bottom: 12px;
      }
    }
    .content-area {
      background: rgba(255,255,255,0.95);
      backdrop-filter: blur(10px);
      border-radius: 16px;
      box-shadow: 0 8px 32px rgba(0,0,0,0.1);
      padding: 20px;
    }
    .category-tabs {
      border-bottom: 2px solid #e0e0e0;
      overflow-x: auto;
      flex-wrap: nowrap;
    }
    .category-tab {
      border: none;
      background: transparent;
      border-bottom: 3px solid transparent;
      color: #666;
      padding: 10px 20px;
      margin-bottom: -2px;
      white-space: nowrap;
      transition: all 0.3s;
    }
    .category-tab:hover {
      color: #667eea;
    }
    .category-tab.active {
      color: #667eea;
      border-bottom-color: #667eea;
    }
    .category-section {
      display: none;
    }
    .category-section.active {
      display: block;
    }
    .tool-card {
      text-decoration: none;
      color: inherit;
      transition: all 0.3s;
      border: 2px solid #e0e0e0;
    }
    .tool-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 8px 25px rgba(102,126,234,0.3) !important;
      border-color: #667eea;
    }
    .tool-icon {
      width: 70px;
      height: 70px;
      border-radius: 50%;
      background: linear-gradient(135deg, #667eea, #764ba2);
      display: flex;
      align-items: center;
      justify-content: center;
      color: #ffffff;
      font-weight: 700;
      font-size: 24px;
      box-shadow: 0 4px 15px rgba(102,126,234,0.3);
      transition: all 0.3s;
      overflow: hidden;
    }
    .tool-card:hover .tool-icon {
      transform: scale(1.1);
      box-shadow: 0 6px 20px rgba(102,126,234,0.4);
    }
    .tool-icon img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 50%;
    }
    .btn-gradient {
      background: linear-gradient(135deg, #667eea, #764ba2);
      border: none;
      color: #ffffff;
      box-shadow: 0 4px 15px rgba(102,126,234,0.3);
    }
    .btn-gradient:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(102,126,234,0.4);
      color: #ffffff;
    }
    .btn-outline-custom {
      background: transparent;
      color: #667eea;
      border: 2px solid #667eea;
    }
    .btn-outline-custom:hover {
      background: #667eea;
      color: #ffffff;
    }
    .alert-box {
      background: #fff3cd;
      border: 1px solid #ffc107;
      border-radius: 8px;
      padding: 12px;
      margin-top: 20px;
    }
    .sidebar-toggle-btn {
      display: none;
      width: 100%;
      border-radius: 16px 16px 0 0;
      margin-bottom: 0;
    }
    @media (max-width: 991.98px) {
      .sidebar-toggle-btn {
        display: flex;
      }
    }
    .sidebar-toggle-icon {
      transition: transform 0.3s ease;
    }
    .sidebar-toggle-btn[aria-expanded="true"] .sidebar-toggle-icon {
      transform: rotate(180deg);
    }
    @media (max-width: 576px) {
      .tool-icon {
        width: 52px;
        height: 52px;
        font-size: 20px;
      }
    }
    ::-webkit-scrollbar {
      width: 6px;
    }
    ::-webkit-scrollbar-track {
      background: #f1f1f1;
      border-radius: 10px;
    }
    ::-webkit-scrollbar-thumb {
      background: linear-gradient(135deg, #667eea, #764ba2);
      border-radius: 10px;
    }
    ::-webkit-scrollbar-thumb:hover {
      background: linear-gradient(135deg, #764ba2, #667eea);
    }
  </style>
</head>
<body class="d-flex flex-column">
  <!-- Header -->
  <header class="header py-3 px-3 px-md-4">
    <div class="container-fluid">
      <div class="d-flex align-items-center justify-content-between flex-wrap">
        <div class="d-flex align-items-center gap-3">
          <div class="logo-circle">C</div>
          <div>
            <h1 class="h5 mb-0 fw-bold">Cyber Crime Police Station</h1>
            <p class="small text-muted mb-0">Navsari · Gujarat Police</p>
          </div>
        </div>
        <div class="d-flex gap-2 mt-2 mt-md-0">
          <a href="cyber_awareness/V4_cyber_awarness_Full.pdf" target="_blank" class="btn btn-outline-custom btn-sm" download="Citizen Awareness">Citizen Awareness</a>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Container -->
  <div class="container-fluid flex-grow-1 py-3 py-md-4">
    <div class="row g-3">
      <!-- Sidebar Toggle Button (mobile only) -->
      <div class="col-12 d-lg-none mb-2">
        <button class="sidebar-toggle-btn btn btn-light w-100 d-flex align-items-center justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleSidebar" aria-expanded="true" aria-controls="collapsibleSidebar" id="sidebarToggleBtn">
          <span>Dashboard</span>
          <i class="bi bi-chevron-down sidebar-toggle-icon"></i>
        </button>
      </div>

      <!-- Sidebar -->
      <div class="col-12 col-lg-3">
        <aside class="sidebar collapse p-3 p-md-4 h-100" id="collapsibleSidebar">
          <h3 class="h5 fw-bold mb-2">Dashboard</h3>
          <p class="small text-muted mb-3">Single-screen access to all investigation portals and cyber tools for Navsari Cyber Cell.</p>
          <div class="d-flex flex-wrap gap-2 mb-4">
            <span class="badge bg-primary">National</span>
            <span class="badge bg-primary">State</span>
            <span class="badge bg-primary">OSINT</span>
            <span class="badge bg-primary">Investigation</span>
          </div>
          <h3 class="h6 fw-bold mt-4 mb-3">Emergency</h3>
          <div class="d-flex flex-column gap-2 mb-3">
            <a href="https://cybercrime.gov.in/" target="_blank" class="btn btn-gradient btn-sm text-center">File Complaint</a>
            <a href="https://www.ceir.gov.in/General/index.jsp" target="_blank" class="btn btn-outline-custom btn-sm text-center">Block Mobile-CEIR</a>
            <a href="https://navsaricyber.com/admin/login" target="_blank" class="btn btn-outline-custom btn-sm text-center">Navsari cyber Portal</a>
          </div>
          <div class="alert-box">
            <strong>⚠️ ALERT:</strong> For cyber fraud, dial 1930 within 2 hours for fund-freeze.
          </div>
        </aside>
      </div>

      <!-- Main Content -->
      <div class="col-12 col-lg-9">
        <main class="content-area h-100">
          <!-- Category Tabs -->
          <ul class="nav category-tabs mb-4" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="category-tab nav-link active" onclick="showCategory('important')" type="button">Important Portals</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="category-tab nav-link" onclick="showCategory('osint')" type="button">OSINT Tools</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="category-tab nav-link" onclick="showCategory('training')" type="button">Investigation</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="category-tab nav-link" onclick="showCategory('lea')" type="button">LEA Portal</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="category-tab nav-link" onclick="showCategory('utilities')" type="button">Utilities</button>
            </li>
          </ul>

          <!-- Important Portals -->
          <div id="category-important" class="category-section active">
            <h2 class="h5 fw-semibold mb-3 pb-2 border-bottom">Important Portals</h2>
            <div class="row g-3">
              <div class="col-6 col-md-3">
                <a href="https://navsaricyber.com/admin/login/" target="_blank" class="card tool-card text-center h-100">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="tool-icon mb-3"><span>🔐</span></div>
                    <div class="small fw-semibold">Navsari Portal</div>
                  </div>
                </a>
              </div>
              <div class="col-6 col-md-3">
                <a href="https://cyberpolice.nic.in/" target="_blank" class="card tool-card text-center h-100">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="tool-icon mb-3"><img src="images/cyberpolice.png" alt="NCCRP"></div>
                    <div class="small fw-semibold">NCCRP</div>
                  </div>
                </a>
              </div>
              <div class="col-6 col-md-3">
                <a href="https://gujaratcybercrime.org/eaglebravo/" target="_blank" class="card tool-card text-center h-100">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="tool-icon mb-3"><img src="images/cyberashvasth.jpg" alt="Cyber Aashvast"></div>
                    <div class="small fw-semibold">Cyber Aashvast</div>
                  </div>
                </a>
              </div>
              <div class="col-6 col-md-3">
                <a href="https://webmail.gujarat.gov.in/owa/" target="_blank" class="card tool-card text-center h-100">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="tool-icon mb-3"><img src="images/outlook.png" alt="Gov Mail"></div>
                    <div class="small fw-semibold">Gov Mail</div>
                  </div>
                </a>
              </div>
              <div class="col-6 col-md-3">
                <a href="https://www.ceir.gov.in/General/index.jsp" target="_blank" class="card tool-card text-center h-100">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="tool-icon mb-3"><img src="images/certin.jpg" alt="CEIR"></div>
                    <div class="small fw-semibold">CEIR</div>
                  </div>
                </a>
              </div>
              <div class="col-6 col-md-3">
                <a href="https://jcct-i4c.mha.gov.in/" target="_blank" class="card tool-card text-center h-100">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="tool-icon mb-3"><img src="images/samanvaya.png" alt="Samanvaya"></div>
                    <div class="small fw-semibold">Samanvaya</div>
                  </div>
                </a>
              </div>
              <div class="col-6 col-md-3">
                <a href="https://icjs.gov.in/ICJS/login" target="_blank" class="card tool-card text-center h-100">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="tool-icon mb-3"><img src="images/icjs.png" alt="ICJS"></div>
                    <div class="small fw-semibold">ICJS Portal</div>
                  </div>
                </a>
              </div>
              <div class="col-6 col-md-3">
                <a href="https://icjs.gov.in/esakshya/" target="_blank" class="card tool-card text-center h-100">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="tool-icon mb-3"><img src="images/esakshya.png" alt="eSakshya"></div>
                    <div class="small fw-semibold">eSakshya</div>
                  </div>
                </a>
              </div>
              <div class="col-6 col-md-3">
                <a href="https://egujcop.gujarat.gov.in/hdiits/" target="_blank" class="card tool-card text-center h-100">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="tool-icon mb-3"><img src="images/egujcop.png" alt="eGujCop"></div>
                    <div class="small fw-semibold">eGujCop</div>
                  </div>
                </a>
              </div>
              <div class="col-6 col-md-3">
                <a href="https://karmyogi.gujarat.gov.in/" target="_blank" class="card tool-card text-center h-100">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="tool-icon mb-3"><img src="images/karmyogi.png" alt="Karmyogi"></div>
                    <div class="small fw-semibold">Karmyogi</div>
                  </div>
                </a>
              </div>
            </div>
          </div>

          <!-- OSINT Tools -->
          <div id="category-osint" class="category-section">
            <h2 class="h5 fw-semibold mb-3 pb-2 border-bottom">OSINT Tools</h2>
            <div class="row g-3">
              <div class="col-6 col-md-3">
                <a href="web/ip.html" target="_blank" class="card tool-card text-center h-100">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="tool-icon mb-3"><img src="images/ipin.png" alt="IP INFO"></div>
                    <div class="small fw-semibold">IP INFO Lookup</div>
                  </div>
                </a>
              </div>
              <div class="col-6 col-md-3">
                <a href="web/webcheaker.html" target="_blank" class="card tool-card text-center h-100">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="tool-icon mb-3"><img src="images/webc.png" alt="Website checker"></div>
                    <div class="small fw-semibold">Website Checker</div>
                  </div>
                </a>
              </div>
              <div class="col-6 col-md-3">
                <a href="https://brahmastra.today/admin/dashboard" target="_blank" class="card tool-card text-center h-100">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="tool-icon mb-3"><img src="images/eklavya.png" alt="Eklavya"></div>
                    <div class="small fw-semibold">Eklavya</div>
                  </div>
                </a>
              </div>
              <div class="col-6 col-md-3">
                <a href="https://osintframework.com/" target="_blank" class="card tool-card text-center h-100">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="tool-icon mb-3"><img src="images/osint.png" alt="OSINT Framework"></div>
                    <div class="small fw-semibold">OSINT Framework</div>
                  </div>
                </a>
              </div>
              <div class="col-6 col-md-3">
                <a href="https://inteltechniques.com/tools/index.html" target="_blank" class="card tool-card text-center h-100">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="tool-icon mb-3"><img src="images/intel.png" alt="IntelTechniques"></div>
                    <div class="small fw-semibold">IntelTechniques</div>
                  </div>
                </a>
              </div>
              <div class="col-6 col-md-3">
                <a href="https://intelx.io/" target="_blank" class="card tool-card text-center h-100">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="tool-icon mb-3"><img src="images/IntelligenceX.png" alt="Intelligence X"></div>
                    <div class="small fw-semibold">Intelligence X</div>
                  </div>
                </a>
              </div>
              <div class="col-6 col-md-3">
                <a href="https://www.shodan.io/" target="_blank" class="card tool-card text-center h-100">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="tool-icon mb-3"><img src="images/sodan.png" alt="Shodan"></div>
                    <div class="small fw-semibold">Shodan</div>
                  </div>
                </a>
              </div>
              <div class="col-6 col-md-3">
                <a href="https://hcservices.ecourts.gov.in/" target="_blank" class="card tool-card text-center h-100">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="tool-icon mb-3"><img src="images/eCourts.png" alt="Case Status"></div>
                    <div class="small fw-semibold">Case Status</div>
                  </div>
                </a>
              </div>
            </div>
          </div>

          <!-- Investigation Tools -->
          <div id="category-training" class="category-section">
            <h2 class="h5 fw-semibold mb-3 pb-2 border-bottom">Investigation Tools</h2>
            <div class="row g-3">
              <div class="col-6 col-md-3">
                <a href="https://www.investigationcamp.com/" target="_blank" class="card tool-card text-center h-100">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="tool-icon mb-3"><img src="images/investigation.png" alt="Investigation Camp"></div>
                    <div class="small fw-semibold">Investigation Camp</div>
                  </div>
                </a>
              </div>
              <div class="col-6 col-md-3">
                <a href="https://www.geospy.net/" target="_blank" class="card tool-card text-center h-100">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="tool-icon mb-3"><img src="images/gs.jpg" alt="GEO SPY"></div>
                    <div class="small fw-semibold">GEO SPY</div>
                  </div>
                </a>
              </div>
              <div class="col-6 col-md-3">
                <a href="https://guru.cyberyodha.org/dashboard#" target="_blank" class="card tool-card text-center h-100">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="tool-icon mb-3"><img src="images/cyberyoddha.png" alt="Cyber Yodha"></div>
                    <div class="small fw-semibold">Cyber Yodha</div>
                  </div>
                </a>
              </div>
              <div class="col-6 col-md-3">
                <a href="https://www.tineye.com/" target="_blank" class="card tool-card text-center h-100">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="tool-icon mb-3"><img src="images/tineye.png" alt="TinEye"></div>
                    <div class="small fw-semibold">TinEye</div>
                  </div>
                </a>
              </div>
              <div class="col-6 col-md-3">
                <a href="https://cytrain.ncrb.gov.in/" target="_blank" class="card tool-card text-center h-100">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="tool-icon mb-3"><img src="images/cytrain.png" alt="Cytrain"></div>
                    <div class="small fw-semibold">Cytrain</div>
                  </div>
                </a>
              </div>
            </div>
          </div>

          <!-- LEA Portal -->
          <div id="category-lea" class="category-section">
            <h2 class="h5 fw-semibold mb-3 pb-2 border-bottom">LEA Portal</h2>
            <div class="row g-3">
              <div class="col-6 col-md-3">
                <a href="https://www.whatsapp.com/records/login/" target="_blank" class="card tool-card text-center h-100">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="tool-icon mb-3"><img src="images/whatsapp.jpg" alt="LEA WhatsApp"></div>
                    <div class="small fw-semibold">LEA WhatsApp</div>
                  </div>
                </a>
              </div>
              <div class="col-6 col-md-3">
                <a href="https://www.facebook.com/records/login/" target="_blank" class="card tool-card text-center h-100">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="tool-icon mb-3"><img src="images/facebook.jpeg" alt="LEA Facebook"></div>
                    <div class="small fw-semibold">LEA Facebook</div>
                  </div>
                </a>
              </div>
              <div class="col-6 col-md-3">
                <a href="https://cybercell.phonepe.com/" target="_blank" class="card tool-card text-center h-100">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="tool-icon mb-3"><img src="images/phonepe.png" alt="LEA PhonePE"></div>
                    <div class="small fw-semibold">LEA Phonepe</div>
                  </div>
                </a>
              </div>
              <div class="col-6 col-md-3">
                <a href="https://lert.uber.com/s/?language=en_US" target="_blank" class="card tool-card text-center h-100">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="tool-icon mb-3"><img src="images/uber.png" alt="LEA Uber"></div>
                    <div class="small fw-semibold">LEA Uber</div>
                  </div>
                </a>
              </div>
              <div class="col-6 col-md-3">
                <a href="https://leportal.microsoft.com/dashboard" target="_blank" class="card tool-card text-center h-100">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="tool-icon mb-3"><img src="images/msoft.png" alt="LEA Microsoft"></div>
                    <div class="small fw-semibold">LEA Microsoft</div>
                  </div>
                </a>
              </div>
              <div class="col-6 col-md-3">
                <a href="https://razorpay.com/support/?cybercrime=true" target="_blank" class="card tool-card text-center h-100">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="tool-icon mb-3"><img src="images/raz.jpeg" alt="RazorPay"></div>
                    <div class="small fw-semibold">LEA Razorpay</div>
                  </div>
                </a>
              </div>
              <div class="col-6 col-md-3">
                <a href="https://ler.amazon.com/us" target="_blank" class="card tool-card text-center h-100">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="tool-icon mb-3"><img src="images/az.png" alt="LEA Amazon"></div>
                    <div class="small fw-semibold">LEA AMAZON</div>
                  </div>
                </a>
              </div>
              <div class="col-6 col-md-3">
                <a href="https://lers.google.com/" target="_blank" class="card tool-card text-center h-100">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="tool-icon mb-3"><img src="images/googlelers.jpg" alt="Google LERS"></div>
                    <div class="small fw-semibold">Google LERS</div>
                  </div>
                </a>
              </div>
              <div class="col-6 col-md-3">
                <a href="https://app.kodexglobal.com/gujarat-state-police,-india/requests" target="_blank" class="card tool-card text-center h-100">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="tool-icon mb-3"><img src="images/kodex.png" alt="Kodex"></div>
                    <div class="small fw-semibold">Kodex</div>
                  </div>
                </a>
              </div>
            </div>
          </div>

          <!-- Utilities -->
          <div id="category-utilities" class="category-section">
            <h2 class="h5 fw-semibold mb-3 pb-2 border-bottom">Utilities</h2>
            <div class="row g-3">
              <div class="col-6 col-md-3">
                <a href="https://www.toolfk.com" target="_blank" class="card tool-card text-center h-100">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="tool-icon mb-3"><img src="images/toolfk.png" alt="Tool FK"></div>
                    <div class="small fw-semibold">Tool FK</div>
                  </div>
                </a>
              </div>
              <div class="col-6 col-md-3">
                <a href="https://www.google.com/maps/d/" target="_blank" class="card tool-card text-center h-100">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="tool-icon mb-3"><img src="images/map.png" alt="Google Maps"></div>
                    <div class="small fw-semibold">Google Maps</div>
                  </div>
                </a>
              </div>
              <div class="col-6 col-md-3">
                <a href="https://translate.google.com/" target="_blank" class="card tool-card text-center h-100">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="tool-icon mb-3"><img src="images/google_translate.png" alt="Translate"></div>
                    <div class="small fw-semibold">Translate</div>
                  </div>
                </a>
              </div>
              <div class="col-6 col-md-3">
                <a href="https://github.com/edoardottt/awesome-hacker-search-engines" target="_blank" class="card tool-card text-center h-100">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="tool-icon mb-3"><img src="images/GitHub.png" alt="Hacker Search"></div>
                    <div class="small fw-semibold">Hacker Search</div>
                  </div>
                </a>
              </div>
              <div class="col-6 col-md-3">
                <a href="https://github.com/topics/kali-linux" target="_blank" class="card tool-card text-center h-100">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="tool-icon mb-3"><img src="images/kali.png" alt="Kali Linux"></div>
                    <div class="small fw-semibold">Kali Linux</div>
                  </div>
                </a>
              </div>
              <div class="col-6 col-md-3">
                <a href="https://lira.epac.to/DOCS-TECH/Hacking/" target="_blank" class="card tool-card text-center h-100">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="tool-icon mb-3"><img src="images/docs.png" alt="DOCS-TECH"></div>
                    <div class="small fw-semibold">DOCS-TECH</div>
                  </div>
                </a>
              </div>
              <div class="col-6 col-md-3">
                <a href="https://www.mindluster.com/" target="_blank" class="card tool-card text-center h-100">
                  <div class="card-body d-flex flex-column align-items-center">
                    <div class="tool-icon mb-3"><img src="images/mindl.jpeg" alt="Mind Luster"></div>
                    <div class="small fw-semibold">Mind Luster</div>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </main>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function showCategory(name) {
      const sections = document.querySelectorAll('.category-section');
      const tabs = document.querySelectorAll('.category-tab');
      sections.forEach(s => s.classList.remove('active'));
      tabs.forEach(t => t.classList.remove('active'));
      document.getElementById('category-' + name).classList.add('active');
      event.target.classList.add('active');
    }

    // Sidebar collapse/expand logic using Bootstrap collapse
    document.addEventListener('DOMContentLoaded', function() {
      const sidebar = document.getElementById('collapsibleSidebar');
      const btn = document.getElementById('sidebarToggleBtn');
      const icon = btn ? btn.querySelector('.sidebar-toggle-icon') : null;
      
      // Use Bootstrap's collapse component
      if (sidebar && btn) {
        // Initialize collapse - start collapsed on mobile
        let bsCollapse;
        if (window.innerWidth < 992) {
          // Mobile: start collapsed (don't add 'show' class)
          bsCollapse = new bootstrap.Collapse(sidebar, {
            toggle: false
          });
          // Ensure it's hidden on mobile
          if (!sidebar.classList.contains('show')) {
            sidebar.classList.remove('show');
          }
          btn.setAttribute('aria-expanded', 'false');
          if (icon) {
            icon.style.transform = 'rotate(0deg)';
          }
        } else {
          // Desktop: always show
          sidebar.classList.add('show');
          btn.setAttribute('aria-expanded', 'true');
          if (icon) {
            icon.style.transform = 'rotate(180deg)';
          }
        }
        
        // Listen to Bootstrap collapse events
        sidebar.addEventListener('show.bs.collapse', function() {
          if (icon) {
            icon.style.transform = 'rotate(180deg)';
          }
          btn.setAttribute('aria-expanded', 'true');
        });
        
        sidebar.addEventListener('hide.bs.collapse', function() {
          if (icon) {
            icon.style.transform = 'rotate(0deg)';
          }
          btn.setAttribute('aria-expanded', 'false');
        });
        
        // Handle window resize - show sidebar on desktop, allow collapse on mobile
        function handleResize() {
          if (window.innerWidth >= 992) {
            // Desktop: always show sidebar
            if (bsCollapse) {
              bsCollapse.dispose();
              bsCollapse = null;
            }
            sidebar.classList.add('show');
            btn.setAttribute('aria-expanded', 'true');
            if (icon) {
              icon.style.transform = 'rotate(180deg)';
            }
          } else {
            // Mobile: initialize collapse if not already done
            if (!bsCollapse) {
              bsCollapse = new bootstrap.Collapse(sidebar, {
                toggle: false
              });
            }
          }
        }
        
        // Listen to resize events
        window.addEventListener('resize', handleResize);
      }
    });
  </script>
</body>
</html>
