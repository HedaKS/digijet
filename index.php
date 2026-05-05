<?php 
$pageTitle = "Accueil";
include 'includes/header.php'; 
?>

<section class="hero reveal">
    <div class="container">
        <h1>DigiJet</h1>
        <p><i>Votre Site, Votre Réussite !</i></p>
        <div class="hero-btns reveal">
            <a href="/digijet/tarifs" class="btn btn-primary">Voir les tarifs</a>
            <a href="/digijet/contact" class="btn btn-secondary">Me contacter</a>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="text-center section-title reveal">
            <h2>Pour qui ?</h2>
            <p>Des solutions sur mesure pour accélérer votre croissance</p>
        </div>
        
        <div class="grid-4">
            <div class="card text-center reveal">
                <i class="fas fa-building fa-2x" style="color:var(--accent-color); margin-bottom:20px;"></i>
                <h3>Entreprises</h3>
                <p>Renforcez votre image de marque et attirez plus de clients qualifiés.</p>
            </div>
            <div class="card text-center reveal">
                <i class="fas fa-user-tie fa-2x" style="color:var(--accent-color); margin-bottom:20px;"></i>
                <h3>Indépendants</h3>
                <p>Présentez vos services avec un site vitrine professionnel et percutant.</p>
            </div>
            <div class="card text-center reveal">
                <i class="fas fa-users fa-2x" style="color:var(--accent-color); margin-bottom:20px;"></i>
                <h3>Associations</h3>
                <p>Communiquez efficacement sur vos actions et vos événements.</p>
            </div>
            <div class="card text-center reveal">
                <i class="fas fa-palette fa-2x" style="color:var(--accent-color); margin-bottom:20px;"></i>
                <h3>Artistes</h3>
                <p>Un portfolio élégant et immersif pour exposer vos créations.</p>
            </div>
        </div>
    </div>
</section>

<section class="services-carousel-section bg-light reveal">
    <div class="container">
        <div class="text-center section-title">
            <h2>Mes Services</h2>
            <p>Tout ce dont vous avez besoin pour réussir en ligne</p>
        </div>
        
        <div class="carousel-wrapper">
            
            <button class="carousel-btn prev-btn"><i class="fas fa-chevron-left"></i></button>

            <div class="carousel-track-container">
                <ul class="carousel-track">
                    
                    <li class="carousel-slide current-slide">
                        <div class="card service-card">
                            <h3><i class="fas fa-laptop-code" style="color:var(--gold-color); margin-right:10px;"></i> Création Web</h3>
                            <p>Sites responsive, design moderne et respect des standards web actuels.</p>
                        </div>
                    </li>

                    <li class="carousel-slide">
                        <div class="card service-card">
                            <h3><i class="fas fa-search" style="color:var(--gold-color); margin-right:10px;"></i> SEO</h3>
                            <p>Optimisation complète du référencement pour être visible sur Google.</p>
                        </div>
                    </li>

                    <li class="carousel-slide">
                        <div class="card service-card">
                            <h3><i class="fas fa-server" style="color:var(--gold-color); margin-right:10px;"></i> Hébergement</h3>
                            <p>Gestion technique intégrale de votre hébergement et nom de domaine.</p>
                        </div>
                    </li>

                    <li class="carousel-slide">
                        <div class="card service-card">
                            <h3><i class="fas fa-tools" style="color:var(--gold-color); margin-right:10px;"></i> Maintenance</h3>
                            <p>Mises à jour régulières pour garantir performance et stabilité.</p>
                        </div>
                    </li>

                    <li class="carousel-slide">
                        <div class="card service-card">
                            <h3><i class="fas fa-lock" style="color:var(--gold-color); margin-right:10px;"></i> Sécurité</h3>
                            <p>Protection avancée de vos données et certificats SSL (HTTPS).</p>
                        </div>
                    </li>

                </ul>
            </div>

            <button class="carousel-btn next-btn"><i class="fas fa-chevron-right"></i></button>
        </div>

        <div class="carousel-nav">
            <button class="carousel-indicator current-slide"></button>
            <button class="carousel-indicator"></button>
            <button class="carousel-indicator"></button>
            <button class="carousel-indicator"></button>
            <button class="carousel-indicator"></button>
        </div>

    </div>
</section>


<section class="reveal">
    <div id="divPropos" class="container" style="display:flex; align-items:center; gap:60px; flex-wrap:wrap;">
        <div style="flex:1">
            <h2>À propos de nous</h2>
            <br>
            <p><strong>Martial Ryan</strong>, Développeur web passionné basé à La Réunion, diplômé d’un bac+2 en développement web et web mobile.</p>
            <br>
            <p>J’ai fondé <strong>DigiJet</strong> il y a un an et demi pour proposer des sites modernes, rapides et faciles à utiliser, pensés pour les entreprises qui veulent une présence en ligne pro.</p>
            <p>Actif depuis plusieurs années dans l’univers du digital, je travaille aussi autour de l’<strong>IA</strong>, de l’<strong>automatisation</strong> et des nouvelles technologies.</p>
            <p>Avec <strong>DigiJet</strong>, vous parlez à une vraie personne : je vous accompagne du premier message jusqu’à la mise en ligne de votre projet web.</p>
            <br>
            <a href="/digijet/contact" style="color:var(--accent-color); font-weight:700; border-bottom:2px solid var(--gold-color);">Discuter de votre projet &rarr;</a>
        </div>
        <div class="div-portrait" style="text-align: center;"> 
            <img src="assets/images/personne/ryan3_bg.jpg" alt="MARTIAL Ryan" class="ryan-portrait">
        </div>
    </div>
</section>

<section class="realisation-carousel-section bg-light reveal">
    <div class="container">
        <div class="text-center section-title">
            <h2>Réalisations</h2>
            <p>Découvrez mes derniers projets web</p>
        </div>
        
        <div class="carousel-wrapper">
            
            <button class="carousel-btn prev-btn"><i class="fas fa-chevron-left"></i></button>

            <div class="carousel-track-container">
                <ul class="carousel-track">
                
                    <li class="carousel-slide current-slide">
                        <div class="card realisation-card">
                            <div class="ribbon ribbon-reel">Projet Réel</div>
                            
                            <div class="cardRealisation">
                                <img src="assets/images/site/sakalava-preview.png" alt="Sakalava Lodge" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                            </div>
                            <h3>Sakalava Lodge</h3>
                            <p>Site vitrine sur-mesure pour un lodge dédié aux séjours kitesurf et wing foil à Madagascar.</p> 
                            <a href="https://sakalava.com" target="_blank" style="color:var(--accent-color); font-weight:bold;">Voir le projet &rarr;</a>
                        </div>
                    </li>

                    <li class="carousel-slide current-slide">
                        <div class="card realisation-card">
                            <div class="ribbon ribbon-fictif">Projet Fictif</div>

                            <div class="cardRealisation">
                                <img src="assets/images/site/delcourtAssocies-preview.png" alt="Delcourt & Associés" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                            </div>
                            <h3>Delcourt & Associés</h3>
                            <p>Site vitrine professionnel pour un cabinet d’avocats à Bordeaux, spécialisé en droit immobilier et droit du travail.</p> 
                            <!-- <a href="https://delcourtssocies.digijet.fr/" target="_blank" style="color:var(--accent-color); font-weight:bold;">Voir le projet &rarr;</a> -->
                        </div>
                    </li>

                    <li class="carousel-slide current-slide">
                        <div class="card realisation-card">
                            <div class="ribbon ribbon-fictif">Projet Fictif</div>

                            <div class="cardRealisation">
                                <img src="assets/images/site/elanvital-preview.png" alt="Élan Vital" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                            </div>
                            <h3>Élan Vital</h3>
                            <p>Site zen et épuré pour un institut de soins naturels à La Réunion : massages, soins énergétiques et réservation en ligne.</p> 
                            <!-- <a href="https://elanvital.digijet.fr/" target="_blank" style="color:var(--accent-color); font-weight:bold;">Voir le projet &rarr;</a> -->
                        </div>
                    </li>

                    <li class="carousel-slide current-slide">
                        <div class="card realisation-card">
                            <div class="ribbon ribbon-fictif">Projet Fictif</div>

                            <div class="cardRealisation">
                                <img src="assets/images/site/mobifixexpress-preview.png" alt="Mobifix Express" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                            </div>
                            <h3>Mobifix Express</h3>
                            <p>Site moderne pour un réparateur mobile à domicile à Lyon, avec prise de rendez-vous rapide et services détaillés.</p> 
                            <!-- <a href="https://mobifixexpress.digijet.fr/" target="_blank" style="color:var(--accent-color); font-weight:bold;">Voir le projet &rarr;</a> -->
                        </div>
                    </li>

                    <li class="carousel-slide current-slide">
                        <div class="card realisation-card">
                            <div class="ribbon ribbon-fictif">Projet Fictif</div>

                            <div class="cardRealisation">
                                <img src="assets/images/site/lamiedumatin-preview.png" alt="La Mie du Matin" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                            </div>
                            <h3>La Mie du Matin</h3>
                            <p>Site chaleureux pour une boulangerie artisanale à Lille : produits bio, créations de saison et fidélité digitale.</p> 
                            <!-- <a href="https://lamiedumatin.digijet.fr/" target="_blank" style="color:var(--accent-color); font-weight:bold;">Voir le projet &rarr;</a> -->
                        </div>
                    </li>

                </ul>
            </div>

            <button class="carousel-btn next-btn"><i class="fas fa-chevron-right"></i></button>
        </div>

        <div class="carousel-nav">
            <button class="carousel-indicator current-slide"></button>
            <button class="carousel-indicator"></button>
            <button class="carousel-indicator"></button>
            <button class="carousel-indicator"></button>
        </div>

    </div>
</section>

<section style="background: linear-gradient(135deg, var(--primary-color), #1e293b); color: white; text-align: center;" class="reveal">
    <div class="container" style="display: flex; align-items: center; justify-content: center; flex-direction: column;">
        <h2 style="color:white; margin-bottom:20px;">Prêt à lancer votre site ?</h2>
        <p style="color: #cbd5e1; margin-bottom: 30px;">Transformez vos idées en réalité digitale dès aujourd'hui.</p>
        <a href="/digijet/contact" class="btn" style="background:white; color:var(--primary-color);">Demander un devis gratuit</a>
    </div>
</section>

<?php include 'includes/footer.php'; ?>