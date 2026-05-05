<?php
ob_start(); // <--- CETTE LIGNE EMPÊCHE LES BUGS D'ESPACES VIDES AVANT LE HEADER

// Chargement de PHPMailer via Composer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'vendor/autoload.php';

// Chargement simple du fichier .env sans dépendance externe
if (file_exists(__DIR__ . '/.env')) {
    $envLines = file(__DIR__ . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($envLines as $line) {
        $line = trim($line);

        if ($line === '' || str_starts_with($line, '#')) {
            continue;
        }

        [$key, $value] = array_pad(explode('=', $line, 2), 2, '');

        $_ENV[trim($key)] = trim($value, " \t\n\r\0\x0B\"'");
    }
}

// Chargement simple du fichier .env sans dépendance externe
if (file_exists(__DIR__ . '/.env')) {
    $envLines = file(__DIR__ . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($envLines as $line) {
        $line = trim($line);

        if ($line === '' || str_starts_with($line, '#')) {
            continue;
        }

        [$key, $value] = array_pad(explode('=', $line, 2), 2, '');

        $_ENV[trim($key)] = trim($value, " \t\n\r\0\x0B\"'");
    }
}

// --- CONFIGURATION SMTP ---
$smtpHost = $_ENV['SMTP_HOST'] ?? '';
$smtpUsername = $_ENV['SMTP_USERNAME'] ?? '';
$smtpPassword = $_ENV['SMTP_PASSWORD'] ?? '';
$smtpPort = (int)($_ENV['SMTP_PORT'] ?? 587);

// --- CONFIGURATION GÉNÉRALE ---
$adminEmailMain = $_ENV['ADMIN_EMAIL_MAIN'] ?? '';
$adminEmailPerso = $_ENV['ADMIN_EMAIL_PERSONAL'] ?? '';
$siteName = $_ENV['SITE_NAME'] ?? 'DigiJet';
$accentColor = "#f256be";
$bgColor = "#f3f4f6";

// Variables d'affichage
$msg = "";
$msgClass = "";

// TRAITEMENT DU FORMULAIRE
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 1. Nettoyage des données
    $prenom = htmlspecialchars(trim($_POST['prenom']));
    $nom = htmlspecialchars(trim($_POST['nom']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $objet = htmlspecialchars(trim($_POST['objet']));
    $messageRaw = htmlspecialchars(trim($_POST['message']));
    $messageHtml = nl2br($messageRaw);

    // 2. Validation basique
    if (!empty($prenom) && !empty($nom) && !empty($email) && !empty($messageRaw) && filter_var($email, FILTER_VALIDATE_EMAIL)) {

        // --- Template Admin ---
        $bodyAdmin = <<<HTML
        <!DOCTYPE html>
        <html>
        <head>
            <style>
                body { font-family: 'Inter', Arial, sans-serif; line-height: 1.6; color: #333; background-color: $bgColor; margin: 0; padding: 0; }
                .container { max-width: 600px; margin: 20px auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
                .header { border-bottom: 2px solid $accentColor; padding-bottom: 15px; margin-bottom: 20px; }
                .header h2 { margin: 0; color: $accentColor; font-size: 20px; }
                .info-group { margin-bottom: 15px; }
                .label { font-weight: bold; color: #555; }
                .message-box { background: #f9fafb; border-left: 4px solid $accentColor; padding: 15px; margin-top: 20px; border-radius: 4px; }
                .footer { margin-top: 30px; font-size: 12px; color: #999; text-align: center; border-top: 1px solid #eee; padding-top: 10px; }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header"><h2>📩 Nouveau message reçu</h2></div>
                <div class="info-group"><span class="label">De :</span> $prenom $nom</div>
                <div class="info-group"><span class="label">Email :</span> <a href="mailto:$email" style="color:$accentColor">$email</a></div>
                <div class="info-group"><span class="label">Objet :</span> $objet</div>
                <div class="message-box"><span class="label">Message :</span><br><br>$messageHtml</div>
                <div class="footer">Envoyé via le site DigiJet.</div>
            </div>
        </body>
        </html>
HTML;

        // --- Template Client ---
        $linkTarifs = "https://" . $_SERVER['HTTP_HOST'] . "/tarifs";
        $bodyUser = <<<HTML
        <!DOCTYPE html>
        <html>
        <head>
            <style>
                body { font-family: 'Inter', Arial, sans-serif; line-height: 1.6; color: #333; background-color: $bgColor; margin: 0; padding: 0; }
                .container { max-width: 600px; margin: 20px auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
                .logo { text-align: center; margin-bottom: 20px; font-weight: bold; font-size: 24px; color: #111; }
                .accent { color: $accentColor; }
                .content { margin-bottom: 30px; }
                .btn { display: inline-block; background-color: $accentColor; color: #fff; text-decoration: none; padding: 12px 25px; border-radius: 5px; font-weight: bold; }
                .footer { margin-top: 30px; font-size: 12px; color: #999; text-align: center; border-top: 1px solid #eee; padding-top: 10px; }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="logo">Digi<span class="accent">Jet</span></div>
                <div class="content">
                    <p>Bonjour <strong>$prenom</strong>,</p>
                    <p>Merci de nous avoir contactés. Nous avons bien reçu votre message concernant : <em>$objet</em>.</p>
                    <p>Nous étudions votre demande et reviendrons vers vous sous <strong>48h maximum</strong>.</p>
                    <div style="text-align: center; margin-top: 25px;"><a href="$linkTarifs" class="btn">Voir nos tarifs</a></div>
                </div>
                <div class="footer">&copy; DigiJet La Réunion. Ceci est un message automatique.</div>
            </div>
        </body>
        </html>
HTML;

        // --- ENVOI SMTP ---
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = $smtpHost;
            $mail->SMTPAuth   = true;
            $mail->Username   = $smtpUsername;
            $mail->Password   = $smtpPassword;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = $smtpPort;
            $mail->CharSet    = 'UTF-8';

            // Envoi Admin (DOUBLE DESTINATAIRE)
            $mail->setFrom($smtpUsername, $siteName);
            $mail->addAddress($adminEmailMain);
            $mail->addAddress($adminEmailPerso); // <-- Ton mail Outlook ajouté ici
            $mail->addReplyTo($email, "$prenom $nom");

            $mail->isHTML(true);
            $mail->Subject = "📩 Nouveau message : " . $objet;
            $mail->Body    = $bodyAdmin;
            $mail->AltBody = strip_tags($messageRaw);
            $mail->send();

            // Envoi Client
            $mail->clearAddresses();
            $mail->clearReplyTos();
            $mail->addAddress($email);
            $mail->addReplyTo($adminEmailMain, $siteName);

            $mail->Subject = "✔️ Message bien reçu – $siteName";
            $mail->Body    = $bodyUser;
            $mail->AltBody = "Bonjour $prenom, nous avons bien reçu votre message.";
            $mail->send();

            $msg = "Merci ! Votre message a bien été envoyé.";
            $msgClass = "alert-success";

        } catch (Exception $e) {
            $msg = "Erreur technique : {$mail->ErrorInfo}";
            $msgClass = "alert-error";
        }

    } else {
        $msg = "Veuillez remplir tous les champs correctement.";
        $msgClass = "alert-error";
    }
}

$pageTitle = "Contact";
include 'includes/header.php'; 
ob_end_flush(); // Envoie tout le contenu propre
?>

<section class="section-padding bg-light reveal">
    <div class="container">
        <div class="text-center section-title">
            <h1>Contactez-moi</h1>
            <p>Un projet ? Une question ? Parlons-en autour d'un café virtuel.</p>
        </div>

        <div class="contact-wrapper">
            
            <div class="contact-form reveal">
                <?php if($msg != ""): ?>
                    <div class="alert <?php echo $msgClass; ?>">
                        <?php echo $msg; ?>
                    </div>
                <?php endif; ?>

                <form method="post" action="">
                    <div class="grid-2" style="gap:20px; grid-template-columns: 1fr 1fr; display:grid; margin-bottom:20px;">
                        <div class="form-group" style="margin-bottom:0;">
                            <label for="prenom">Prénom *</label>
                            <input type="text" name="prenom" id="prenom" class="form-control" required>
                        </div>
                        <div class="form-group" style="margin-bottom:0;">
                            <label for="nom">Nom *</label>
                            <input type="text" name="nom" id="nom" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="objet">Objet *</label>
                        <select name="objet" id="objet" class="form-control">
                            <option value="Site One Page">Site One Page</option>
                            <option value="Site vitrine">Site vitrine</option>
                            <option value="Site blog">Site blog</option>
                            <option value="Devis personnalisé">Devis personnalisé</option>
                            <option value="Autre demande">Autre demande</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="message">Votre Message *</label>
                        <textarea name="message" id="message" class="form-control" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary" style="width:100%;">Envoyer</button>
                </form>
            </div>

            <div class="contact-info reveal">
                <div class="info-box">
                    <h3>Vous ne savez pas par où commencer ?</h3>
                    <p style="margin-bottom:15px; color:#666;">Consultez mes offres détaillées.</p>
                    <a href="/digijet/tarifs" class="btn btn-secondary">Nos Tarifs</a>
                </div>

                <div class="info-box dark">
                    <h3 style="color: white!important;">Envoyez moi un message directement !</h3>
                    <p style="font-size:1.3rem; margin-top:15px; font-weight:bold; color:var(--gold-color);">+33 7 43 50 10 52</p>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>