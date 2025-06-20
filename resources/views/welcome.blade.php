<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyber Crime Police Station Navsari - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;

        }

        .header {
            background-color: #14195d;
            color: white;
            padding: 20px;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }

        .header h1 {
            margin-left: 20px;
        }

        .header p {
            margin-left: 20px;
        }

        .category-title {
            color: #14195d;
            border-bottom: 2px solid #000;
            padding-bottom: 5px;
            margin-bottom: 20px;
        }

        .icon-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            background-color: white;
            transition: transform 0.2s;
            text-align: center;
        }

        .icon-card:hover {
            transform: scale(1.05);
            border-color: #14195d;
        }

        .icon-img {
            max-width: 100%;
            height: 80px;
            margin-bottom: 10px;
            object-fit: contain;
        }

        .custom-btn {
            background-color: #14195d;
            color: #ffec00;
            border: none;
        }

        .custom-btn:hover {
            background-color: #0f1445;
            color: #ffffff;
        }

        .category-section {
            margin-bottom: 50px;
        }



        .header-image {
            height: 100px;
            width: auto;
            max-width: auto;

        }

        @media (max-width: 767px) {
            .header {
                flex-direction: column;
                text-align: center;
                max-width: 1200px;
            }

            .header h1,
            .header p {
                margin-left: 0;
                margin-top: 10px;
            }
        }
    </style>
</head>

<body>

    <div class="header">
        <img src="images/egujcop.png" alt="Logo" class="header-image">
        <h1>Cyber Crime Police Station - Navsari</h1>
        <a href="/admin" class="btn btn-warning ms-auto"
            style="margin-left:auto; margin-right:0; background-color:#ffec00; color:#14195d; font-weight:bold;">Login</a>
    </div>


    <div class="container mt-4">
        <div id="dashboard"></div>
    </div>

    <script>
        const jsonData = {
            "categories": [{
                    "name": "Goverment",
                    "items": [{
                            "name": "Cyber Police",
                            "url": "https://cyberpolice.nic.in/",
                            "iconLink": "images/nccrp.jpg"
                        },
                        {
                            "name": "Cyber Aashvast",
                            "url": "https://gujaratcybercrime.org/eaglebravo/",
                            "iconLink": "images/cyberashvasth.jpg"
                        },
                        {
                            "name": "Goverment Mail",
                            "url": "https://webmail.gujarat.gov.in/owa/",
                            "iconLink": "images/outlook.png"
                        },
                        {
                            "name": "eGujcop",
                            "url": "https://egujcop.gujarat.gov.in/hdiits/",
                            "iconLink": "images/egujcop.png"
                        },
                        {
                            "name": "Investigation Camp",
                            "url": "https://www.investigationcamp.com/",
                            "iconLink": "images/investigation.png"
                        },
                        {
                            "name": "LEA WhatsApp",
                            "url": "https://www.whatsapp.com/records/login/",
                            "iconLink": "images/whatsapp.jpg"
                        },
                        {
                            "name": "LEA Facebook",
                            "url": "https://www.facebook.com/records/login/",
                            "iconLink": "images/facebook.jpeg"
                        },
                        {
                            "name": "Google LERS",
                            "url": "https://lers.google.com/",
                            "iconLink": "images/googlelers.jpg"
                        },
                        {
                            "name": "CEIR",
                            "url": "https://www.ceir.gov.in/General/index.jsp",
                            "iconLink": "images/sancharsaathi.png"
                        },
                        {
                            "name": "Eklavya",
                            "url": "https://brahmastra.today/admin/dashboard",
                            "iconLink": "images/eklavya.png"
                        },
                        {
                            "name": "Samanvaya",
                            "url": " https://jcct-i4c.mha.gov.in/",
                            "iconLink": "images/samanvaya.png"
                        },



                    ]
                },
                // {
                //   "name": "Cyber",
                //   "items": [

                //   ]
                // },
                {
                    "name": "Cyber Tools",
                    "items": [{
                            "name": "Cyber Yodha",
                            "url": "https://guru.cyberyodha.org/dashboard#",
                            "iconLink": "images/cyberyoddha.png"
                        },
                        {
                            "name": "OSINT Framework",
                            "url": "https://osintframework.com/",
                            "iconLink": "images/osint.png"
                        },
                        {
                            "name": "Cyber Weapons Lab",
                            "url": "https://null-byte.wonderhowto.com/collection/cyber-weapons-lab/",
                            "iconLink": "images/wonderhowto.png"
                        },
                        {
                            "name": "IntelTechniques Search Tool",
                            "url": "https://inteltechniques.com/tools/index.html",
                            "iconLink": "images/intel.png"
                        },
                        {
                            "name": "Karmyogi",
                            "url": "https://karmyogi.gujarat.gov.in/",
                            "iconLink": "images/karmyogi.png"
                        },
                        {
                            "name": "Cytrain",
                            "url": "https://cytrain.ncrb.gov.in/",
                            "iconLink": "images/cytrain.png"
                        },
                        {
                            "name": "ICJS",
                            "url": "https://icjs.gov.in/ICJS/login",
                            "iconLink": "images/icjs.png"
                        },
                        {
                            "name": "eSakshya",
                            "url": "https://icjs.gov.in/esakshya/",
                            "iconLink": "images/esakshya.png"
                        },
                        {
                            "name": "CyberSafe",
                            "url": "https://cybersafe.gov.in/",
                            "iconLink": "images/cybersafe.png"
                        },
                        {
                            "name": "Case Status",
                            "url": "https://hcservices.ecourts.gov.in/ecourtindiaHC/cases/case_no.php",
                            "iconLink": "images/eCourts.png"
                        },
                        {
                            "name": "Intelligence X",
                            "url": "https://intelx.io/",
                            "iconLink": "images/IntelligenceX.svg"
                        },
                        {
                            "name": "urlDNA",
                            "url": "https://urldna.io/",
                            "iconLink": "images/urldna.png"
                        },
                        {
                            "name": "Web Check",
                            "url": "https://web-check.xyz/",
                            "iconLink": "images/web_check.png"
                        },
                        {
                            "name": "Cybersecurity",
                            "url": "https://inventyourshit.com/hacking/",
                            "iconLink": "images/ajax.webp"
                        },
                        {
                            "name": "GitHub Hacker Engines",
                            "url": "https://github.com/edoardottt/awesome-hacker-search-engines",
                            "iconLink": "images/GitHub.png"
                        },
                        {
                            "name": "Kali Linux",
                            "url": "https://github.com/topics/kali-linux",
                            "iconLink": "images/kali.png"
                        },
                        {
                            "name": "Cleanup Pictures",
                            "url": "https://cleanup.pictures/",
                            "iconLink": "images/cleanup.svg"
                        },
                        {
                            "name": "DOCS-TECH Hacking",
                            "url": "https://lira.epac.to/DOCS-TECH/Hacking/",
                            "iconLink": "images/docs.png"
                        },
                        {
                            "name": "Untools",
                            "url": "https://untools.co/",
                            "iconLink": "images/untools.png"
                        },
                        {
                            "name": "TinEye Search",
                            "url": "https://www.tineye.com/",
                            "iconLink": "images/tineye.png"
                        },
                        {
                            "name": "Gmail",
                            "url": "https://mail.google.com/mail/?shva=1#inbox",
                            "iconLink": "images/googlelers.jpg"
                        },
                        {
                            "name": "Kodex",
                            "url": "https://app.kodexglobal.com/gujarat-state-police,-india/requests",
                            "iconLink": "images/kodex.png"
                        },
                        {
                            "name": "IP Info",
                            "url": "https://ipinfo.io/",
                            "iconLink": "images/positive.svg"
                        },
                        {
                            "name": "IP Tracker",
                            "url": "https://tracker.iplocation.net/",
                            "iconLink": "images/iplocation.png"
                        },
                        {
                            "name": "Whois IP",
                            "url": "https://www.whois.com/whois/",
                            "iconLink": "images/whoisIp.svg"
                        },
                        {
                            "name": "User Search",
                            "url": "https://www.usersearch.org/",
                            "iconLink": "images/users_search.png"
                        },
                        {
                            "name": "Google Maps",
                            "url": "https://www.google.com/maps/d/",
                            "iconLink": "images/map.png"
                        },

                        {
                            "name": "Translate",
                            "url": "https://translate.google.com/",
                            "iconLink": "images/google_translate.png"
                        },

                    ]
                }
            ]
        }

        const dashboard = document.getElementById('dashboard');

        // Filter and group the .gov sites into a new 'Government' category
        const governmentCategory = {
            name: 'Government',
            items: []
        };

        jsonData.categories.forEach(category => {
            category.items = category.items.filter(item => {

                return true;
            });
        });


        // Render the dashboard
        jsonData.categories.forEach(category => {
            const section = document.createElement('div');
            section.className = 'category-section';

            const title = document.createElement('h3');
            title.className = 'category-title';
            title.textContent = category.name;

            const row = document.createElement('div');
            row.className = 'row';

            category.items.forEach(item => {
                const col = document.createElement('div');
                col.className = 'col-md-3 mb-4';

                col.innerHTML = `
        <div class="icon-card">
          <a href="${item.url}" target="_blank" style="text-decoration: none; color: inherit;">
            <img src="${item.iconLink}" class="icon-img" alt="${item.name}">
            <h6>${item.name}</h6>
          </a>
        </div>
      `;

                row.appendChild(col);
            });

            section.appendChild(title);
            section.appendChild(row);
            dashboard.appendChild(section);
        });
    </script>

</body>

</html>
