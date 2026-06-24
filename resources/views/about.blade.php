@extends('layouts.app')

@section('title', 'ASC DISSO - Dossier de Présentation & Partenariat')
@section('meta_description', 'Dossier de présentation de l\'ASC DISSO, club sportif et culturel de Mboro. Découvrez nos valeurs, nos actions et nos opportunités de partenariat.')
@section('meta_keywords', 'ASC DISSO, Mboro, club sportif, partenariat, sponsoring, Navétanes, Sénégal')
@section('canonical_url', route('about'))

@section('og_title', 'ASC DISSO - Dossier de Présentation & Partenariat')
@section('og_description', 'Dossier de présentation de l\'ASC DISSO, club sportif et culturel de Mboro.')
@section('og_image', asset('images/logo.png'))
@section('og_url', route('about'))

@section('content')
<style>
            .bg-primary-marron {
            background-color: #8C1C1C;
        }
        .text-primary-marron {
            color: #8C1C1C;
        }
        .border-primary-marron {
            border-color: #8C1C1C;
        }
</style>
<div class="bg-gray-50">
    <!-- Hero Section -->
    <div class="relative py-24 md:py-32 overflow-hidden">
        <div class="absolute inset-0 bg-primary-dark">
            <div class="absolute inset-0 opacity-30" style="background-image: url('https://images.pexels.com/photos/114296/pexels-photo-114296.jpeg?auto=compress&cs=tinysrgb&w=1600'); background-size: cover; background-position: center;"></div>
        </div>
        
        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-3xl mx-auto text-center">
                <div class="w-24 h-24 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-6 border-2 border-white border-opacity-30">
                    <img src="{{ asset('images/logo.png') }}" alt="ASC Disso" class="w-16 h-16">
                </div>
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-4">A propos de l'ASC Disso</h1>
                <p class="text-xl text-white opacity-90">SAISON OFFICIELLE 2026</p>
                <p class="text-lg text-white opacity-80 mt-2">« Unir la jeunesse, impacter la communauté »</p>
            </div>
        </div>
    </div>

    <!-- À PROPOS DE L'ASC DISSO -->
    <div class="container mx-auto px-4 py-16">
        <div class="max-w-4xl mx-auto">
            <span class="text-primary-marron font-bold text-xl uppercase mb-4 block border-l-4 border-primary-marron pl-3">À PROPOS DE L'ASC DISSO</span>
            
            <div class="space-y-4 text-gray-700 leading-relaxed">
                <p>
                    L'<strong>ASC DISSO</strong> est une jeune association sportive et culturelle dynamique née de la volonté profonde de rassembler la jeunesse autour des valeurs fondamentales du sport, de la solidarité, du respect, de l'engagement citoyen et du développement communautaire.
                </p>
                <p>
                    Bien plus qu'un simple club de football participant aux tournois locaux, l'ASC DISSO ambitionne de devenir une <strong>véritable marque forte</strong>, porteuse d'impact social structurel et d'initiatives positives de haute utilité publique au sein de sa communauté à Mboro et au-delà.
                </p>
            </div>

            <!-- Image 5 : Conférence de presse -->
            <div class="mt-8 bg-gray-100 border border-gray-200 rounded-lg p-4 text-center overflow-hidden">
                <img src="{{ asset('images/image5_conferences.jpeg') }}" alt="Conférence de presse et allocution des leaders de l'ASC DISSO" class="w-full h-auto rounded-lg object-cover mb-2">
                <div class="text-xs text-gray-400 italic">Présentation officielle de la vision stratégique et des ambitions de l'association devant la communauté.</div>
            </div>
        </div>
    </div>

    <!-- NOS VALEURS FONDAMENTALES -->
    <div class="bg-white py-16">
        <div class="container mx-auto px-4 max-w-4xl">
            <span class="text-primary-marron font-bold text-xl uppercase mb-6 block border-l-4 border-primary-marron pl-3">NOS VALEURS FONDAMENTALES</span>
            
            <p class="text-gray-700 mb-8">
                Notre vision stratégique repose sur quatre piliers cardinaux qui guident chacune de nos actions sur le terrain comme dans la vie citoyenne :
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Valeur 1 -->
                <div class="bg-gray-50 p-6 rounded-lg border-l-4 border-primary-marron">
                    <h3 class="font-bold text-lg text-primary-marron mb-2">1. Travail</h3>
                    <p class="text-gray-600 text-sm">La rigueur, la préparation méticuleuse et l'effort continu pour atteindre l'excellence sportive et sociale.</p>
                </div>

                <!-- Valeur 2 -->
                <div class="bg-gray-50 p-6 rounded-lg border-l-4 border-primary-marron">
                    <h3 class="font-bold text-lg text-primary-marron mb-2">2. Respect</h3>
                    <p class="text-gray-600 text-sm">L'acceptation d'autrui, le fair-play total envers les adversaires, les partenaires et les membres de la communauté.</p>
                </div>

                <!-- Valeur 3 -->
                <div class="bg-gray-50 p-6 rounded-lg border-l-4 border-primary-marron">
                    <h3 class="font-bold text-lg text-primary-marron mb-2">3. Discipline</h3>
                    <p class="text-gray-600 text-sm">Une éthique comportementale irréprochable sur le terrain et en dehors, garantie de la cohésion du groupe.</p>
                </div>

                <!-- Valeur 4 -->
                <div class="bg-gray-50 p-6 rounded-lg border-l-4 border-primary-marron">
                    <h3 class="font-bold text-lg text-primary-marron mb-2">4. Solidarité</h3>
                    <p class="text-gray-600 text-sm">L'entraide active, le soutien aux personnes vulnérables et l'union sacrée pour le développement local.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- UN PROGRAMME D'ACTIVITÉS DIVERSIFIÉ -->
    <div class="container mx-auto px-4 py-16 max-w-4xl">
        <span class="text-primary-marron font-bold text-xl uppercase mb-4 block border-l-4 border-primary-marron pl-3">UN PROGRAMME D'ACTIVITÉS DIVERSIFIÉ</span>
        
        <p class="text-gray-700 mb-8">
            Durant toute la saison 2026, l'ASC DISSO déploie un calendrier d'actions robustes, alliant avec brio performances sportives de premier plan et impact social mesurable :
        </p>

        <div class="mb-12">
            <h3 class="text-lg font-bold text-gray-800 flex items-center mb-4">
                <span class="mr-2">🏆</span> Compétition de haut niveau & Succès Sportifs
            </h3>
            <p class="text-gray-600 mb-4 ml-8">
                Participation active et ambitieuse au championnat Navétane et aux tournois régionaux majeurs. L'équipe se positionne comme un sérieux prétendant aux titres grâce à un encadrement technique rigoureux.
            </p>
            
            <!-- Image 6 : Célébration de l'équipe -->
            <div class="bg-gray-100 border border-gray-200 rounded-lg p-4 text-center overflow-hidden ml-8">
                <img src="{{ asset('images/image6_celebration_equipe.jpeg') }}" alt="Célébration de l'équipe sur le terrain / matchs nocturnes" class="w-full h-auto rounded-lg object-cover mb-2">
                <div class="text-xs text-gray-400 italic">Une jeunesse victorieuse, soudée et fière de porter les couleurs de l'ASC DISSO sous les projecteurs.</div>
            </div>
        </div>

        <div>
            <h3 class="text-lg font-bold text-gray-800 flex items-center mb-4">
                <span class="mr-2">🌱</span> Actions Citoyennes, Environnementales et Humaines
            </h3>
            <p class="text-gray-600 mb-4 ml-8">
                Notre engagement se traduit par des initiatives concrètes sur le terrain : journées de nettoyage intensif (<strong>Set-Setal</strong>) pour assainir les quartiers, et importantes campagnes de reboisement pour lutter contre la désertification et embellir l'espace public.
            </p>

            <!-- Image 1 : Set-Setal -->
            <div class="bg-gray-100 border border-gray-200 rounded-lg p-4 text-center overflow-hidden ml-8">
                <img src="{{ asset('images/image1_set_setal.jpeg') }}" alt="Journée citoyenne de Set-Setal et nettoyage des quartiers" class="w-full h-auto rounded-lg object-cover mb-2">
                <div class="text-xs text-gray-400 italic">Mobilisation massive des membres et sympathisants de l'ASC DISSO pour la propreté et la salubrité de notre commune.</div>
            </div>
        </div>
    </div>

    <!-- ÉLAN DE SOLIDARITÉ ET ENGAGEMENT SOCIAL -->
    <div class="bg-gray-50 py-16">
        <div class="container mx-auto px-4 max-w-4xl">
            <h2 class="text-2xl font-bold text-primary-marron mb-6 border-l-4 border-primary-marron pl-3">Élan de Solidarité et Engagement Social</h2>
            
            <p class="text-gray-700 mb-8">
                L'ASC DISSO est un pilier de l'entraide locale. Nous organisons régulièrement des collectes de don de sang cruciales pour approvisionner les structures sanitaires locales, ainsi que des distributions de packs alimentaires (<strong>Ndogous</strong>) durant le mois béni de Ramadan.
            </p>

            <!-- Image 2 : Distribution Ndogous -->
            <div class="bg-gray-100 border border-gray-200 rounded-lg p-4 text-center overflow-hidden mb-8">
                <img src="{{ asset('images/image2_ndogouss.jpeg') }}" alt="Action sociale et solidaire - distribution de Ndogous" class="w-full h-auto rounded-lg object-cover mb-2">
                <div class="text-xs text-gray-400 italic">Partage et générosité en soirée : les équipes de l'ASC au service direct de la population locale.</div>
            </div>

            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                <span class="mr-2">📋</span> Structuration, Secrétariat et Adhésion Populaire
            </h3>
            <p class="text-gray-600 mb-4">
                Une administration moderne et rigoureuse caractérise notre association. Le lancement des cartes de membre officiels connaît un engouement sans précédent, ancrant durablement le club dans le cœur des habitants de Mboro.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Image 3 : Stand -->
                <div class="bg-gray-100 border border-gray-200 rounded-lg p-4 text-center overflow-hidden">
                    <img src="{{ asset('images/image3_standss.jpeg') }}" alt="Stand DISSO LA BOKK" class="w-full h-auto rounded-lg object-cover mb-2">
                    <div class="text-xs text-gray-400 italic">Bureau d'inscription et de logistique.</div>
                </div>
                <!-- Image 7 : Remise cartes -->
                <div class="bg-gray-100 border border-gray-200 rounded-lg p-4 text-center overflow-hidden">
                    <img src="{{ asset('images/image7_remise_cartes.jpeg') }}" alt="Remise des cartes" class="w-full h-auto rounded-lg object-cover mb-2">
                    <div class="text-xs text-gray-400 italic">Forte mobilisation pour le retrait des cartes de membre.</div>
                </div>
            </div>
        </div>
    </div>
    <!-- POURQUOI DEVENIR PARTENAIRE DE L'ASC DISSO ? -->
    <div class="container mx-auto px-4 py-16 max-w-4xl">
        <h2 class="text-2xl font-bold mb-6 border-l-4 border-primary-marron pl-3 text-primary-marron uppercase tracking-wide">
            POURQUOI DEVENIR PARTENAIRE DE L'ASC DISSO ?
        </h2>
        
        <p class="text-gray-700 mb-10 text-lg leading-relaxed">
            Associer l'image de votre entreprise à l'ASC DISSO vous offre une opportunité unique et hautement stratégique de communication multicanale et de Responsabilité Sociétale d'Entreprise (RSE) :
        </p>

        <div class="space-y-5">
            
            <!-- Bloc 1 -->
            <div class="bg-[#F9F9F9] border border-gray-200 rounded-lg p-6 flex flex-row items-start gap-4 shadow-sm">
                <div class="bg-primary-marron text-white rounded-full w-10 h-10 flex-shrink-0 flex items-center justify-center font-bold text-lg">
                    1
                </div>
                <div>
                    <h3 class="font-bold text-lg text-[#1F2937] mb-1">Visibilité de Masse Exceptionnelle</h3>
                    <p class="text-gray-600 leading-relaxed">Touchez directement une cible jeune, dynamique, passionnée et hautement engagée, présente en masse lors de chaque événement et rencontre sportive.</p>
                </div>
            </div>
            
            <!-- Bloc 2 -->
            <div class="bg-[#F9F9F9] border border-gray-200 rounded-lg p-6 flex flex-row items-start gap-4 shadow-sm">
                <div class="bg-primary-marron text-white rounded-full w-10 h-10 flex-shrink-0 flex items-center justify-center font-bold text-lg">
                    2
                </div>
                <div>
                    <h3 class="font-bold text-lg text-[#1F2937] mb-1">Image Citoyenne de Premier Plan</h3>
                    <p class="text-gray-600 leading-relaxed">Associez votre marque à des valeurs humaines fortes et à des actions concrètes de haute utilité publique (santé publique, environnement, solidarité Ramadan).</p>
                </div>
            </div>

            <!-- Bloc 3 -->
            <div class="bg-[#F9F9F9] border border-gray-200 rounded-lg p-6 flex flex-row items-start gap-4 shadow-sm">
                <div class="bg-primary-marron text-white rounded-full w-10 h-10 flex-shrink-0 flex items-center justify-center font-bold text-lg">
                    3
                </div>
                <div>
                    <h3 class="font-bold text-lg text-[#1F2937] mb-1">Exposition Multi-support & Médias Actifs</h3>
                    <p class="text-gray-600 leading-relaxed">Profitez d'une visibilité exclusive sur nos maillots de match, nos plateformes digitales modernes et lors des retransmissions de nos matchs phares en direct streaming sur internet.</p>
                </div>
            </div>

            <!-- Image 8 : Cérémonie trophée -->
            <div class="bg-gray-100 border border-gray-200 rounded-lg p-4 text-center overflow-hidden mt-6">
                <img src="{{ asset('images/image8_ceremonie_trophee.jpeg') }}" alt="Cérémonie officielle de remise de trophée et de distinctions" class="w-full h-auto rounded-lg object-cover mb-2">
                <div class="text-xs text-gray-400 italic">L'excellence récompensée : un moment d'audience maximale pour les marques de nos partenaires et sponsors officiels.</div>
            </div>
        </div>

        <div class="mt-10">
            <h3 class="text-2xl font-bold text-primary-marron mb-6 border-l-4 border-primary-marron pl-3">RAYONNEMENT LOCAL ET INTERNATIONAL</h3>
            <p class="text-gray-600 leading-relaxed">
                Grâce à la commercialisation et à la distribution à grande échelle de nos maillots officiels premium, à notre communication digitale soignée et à la diffusion numérique internationale de nos événements, votre marque bénéficiera d'une exposition majeure auprès du public local, national, mais également auprès de la très active diaspora sénégalaise à travers le monde.
            </p>
        </div>
    </div>
    <!-- NIVEAUX DE PARTENARIAT -->
    <div class="bg-gray-50 py-16">
        <div class="container mx-auto px-4 max-w-4xl">
            <h2 class="text-2xl font-bold text-primary-marron mb-6 border-l-4 border-primary-marron pl-3">NIVEAUX DE PARTENARIAT</h2>

            <!-- Version Tableau (Desktop et Tablettes) -->
            <div class="hidden md:block overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-6 py-3 border-b border-gray-200 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">NIVEAU DE PARTENARIAT</th>
                            <th class="px-6 py-3 border-b border-gray-200 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">EMPLACEMENT MAILLOT</th>
                            <th class="px-6 py-3 border-b border-gray-200 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">AVANTAGES MAJEURS & VISIBILITÉ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="px-6 py-4 border-b border-gray-200 font-medium">Sponsor Principal</td>
                            <td class="px-6 py-4 border-b border-gray-200">Plein centre sur la poitrine</td>
                            <td class="px-6 py-4 border-b border-gray-200 text-sm">Logo grand format sur la tenue officielle, citation prioritaire dans les médias, présence exclusive sur tous les visuels digitaux.</td>
                        </tr>
                        <tr class="bg-gray-50">
                            <td class="px-6 py-4 border-b border-gray-200 font-medium">Sponsor Officiel</td>
                            <td class="px-6 py-4 border-b border-gray-200">Sur les épaules / manches</td>
                            <td class="px-6 py-4 border-b border-gray-200 text-sm">Logo visible sur les manches, forte présence sur les bannières physiques du club et mentions régulières sur nos réseaux.</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 border-b border-gray-200 font-medium">Partenaire Institutionnel</td>
                            <td class="px-6 py-4 border-b border-gray-200">Dos du maillot / shorts</td>
                            <td class="px-6 py-4 border-b border-gray-200 text-sm">Logo apposé sur les tenues d'entraînement ou supports secondaires, association directe à nos actions citoyennes (RSE).</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Version Cartes (Mobile uniquement) -->
            <div class="md:hidden space-y-4">
                <!-- Carte 1 -->
                <div class="bg-white border border-gray-200 rounded-lg p-5 shadow-sm">
                    <div class="mb-2">
                        <span class="text-xs font-bold text-gray-800 uppercase tracking-wider block">Niveau de partenariat</span>
                        <span class="text-lg font-bold text-primary-marron">Sponsor Principal</span>
                    </div>
                    <div class="mb-2 border-t border-gray-100 pt-2">
                        <span class="text-xs font-bold text-gray-800 uppercase tracking-wider block">Emplacement maillot</span>
                        <span class="text-gray-700">Plein centre sur la poitrine</span>
                    </div>
                    <div class="border-t border-gray-100 pt-2">
                        <span class="text-xs font-bold text-gray-800 uppercase tracking-wider block">Avantages majeurs & visibilité</span>
                        <span class="text-sm text-gray-600">Logo grand format sur la tenue officielle, citation prioritaire dans les médias, présence exclusive sur tous les visuels digitaux.</span>
                    </div>
                </div>

                <!-- Carte 2 -->
                <div class="bg-white border border-gray-200 rounded-lg p-5 shadow-sm">
                    <div class="mb-2">
                        <span class="text-xs font-bold text-gray-800 uppercase tracking-wider block">Niveau de partenariat</span>
                        <span class="text-lg font-bold text-primary-marron">Sponsor Officiel</span>
                    </div>
                    <div class="mb-2 border-t border-gray-100 pt-2">
                        <span class="text-xs font-bold text-gray-800 uppercase tracking-wider block">Emplacement maillot</span>
                        <span class="text-gray-700">Sur les épaules / manches</span>
                    </div>
                    <div class="border-t border-gray-100 pt-2">
                        <span class="text-xs font-bold text-gray-800 uppercase tracking-wider block">Avantages majeurs & visibilité</span>
                        <span class="text-sm text-gray-600">Logo visible sur les manches, forte présence sur les bannières physiques du club et mentions régulières sur nos réseaux.</span>
                    </div>
                </div>

                <!-- Carte 3 -->
                <div class="bg-white border border-gray-200 rounded-lg p-5 shadow-sm">
                    <div class="mb-2">
                        <span class="text-xs font-bold text-gray-800 uppercase tracking-wider block">Niveau de partenariat</span>
                        <span class="text-lg font-bold text-primary-marron">Partenaire Institutionnel</span>
                    </div>
                    <div class="mb-2 border-t border-gray-100 pt-2">
                        <span class="text-xs font-bold text-gray-800 uppercase tracking-wider block">Emplacement maillot</span>
                        <span class="text-gray-700">Dos du maillot / shorts</span>
                    </div>
                    <div class="border-t border-gray-100 pt-2">
                        <span class="text-xs font-bold text-gray-800 uppercase tracking-wider block">Avantages majeurs & visibilité</span>
                        <span class="text-sm text-gray-600">Logo apposé sur les tenues d'entraînement ou supports secondaires, association directe à nos actions citoyennes (RSE).</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                <!-- Image 9 : Maillot rouge -->
                <div class="bg-white border border-gray-200 rounded-lg p-4 text-center overflow-hidden">
                    <img src="{{ asset('images/image9_maillot_rouge.jpeg') }}" alt="Maillot officiel domicile rouge" class="w-full h-auto rounded-lg object-cover mb-2">
                    <div class="text-xs text-gray-400">Template Officiel 2026 - Maillot Rouge Élite</div>
                </div>
                <!-- Image 10 : Maillot blanc -->
                <div class="bg-white border border-gray-200 rounded-lg p-4 text-center overflow-hidden">
                    <img src="{{ asset('images/image10_maillot_blanc.jpeg') }}" alt="Maillot officiel extérieur blanc" class="w-full h-auto rounded-lg object-cover mb-2">
                    <div class="text-xs text-gray-400">Template Officiel 2026 - Maillot Blanc Élite</div>
                </div>
            </div>
        </div>
    </div>

<!-- CONTACT -->
<div class="container mx-auto px-4 py-16 max-w-4xl">
    <h2 class="text-2xl font-bold text-primary-marron mb-6 border-l-4 border-primary-marron pl-3">Ensemble, construisons un partenariat durable</h2>
    
    <p class="text-gray-700 mb-8">
        Nous serions particulièrement honorés d'échanger de vive voix avec vos équipes lors d'un entretien afin d'étudier les modalités pratiques de notre future collaboration.
    </p>

    <!-- Notre Équipe -->
    <div class="container mx-auto px-0 py-0">
        <div class="text-center mb-12">
            <span class="text-primary-red font-semibold text-sm uppercase tracking-wider flex items-center justify-center">
                <span class="w-8 h-0.5 bg-primary-red mr-3"></span>Notre Équipe<span class="w-8 h-0.5 bg-primary-red ml-3"></span>
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-4xl mx-auto">
            <div class="text-center">
                <div class="w-32 h-32 mx-auto mb-4 rounded-full overflow-hidden shadow-lg">
                    <img src="{{ asset('images/president.jpeg') }}" alt="M. Bara Guissé" class="w-full h-full object-cover">
                </div>
                <h3 class="font-bold text-lg">Président</h3>
                <p class="text-primary-red font-medium">M. Bara Guissé</p>
                <p class="text-gray-500 text-sm mt-1">Parrain du club</p>
            </div>

            <div class="text-center">
                <div class="w-32 h-32 mx-auto mb-4 rounded-full overflow-hidden shadow-lg">
                    <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                </div>
                <h3 class="font-bold text-lg">Entraîneur</h3>
                <p class="text-primary-red font-medium">M. [Nom de l'Entraîneur]</p>
                <p class="text-gray-500 text-sm mt-1">Coach principal</p>
            </div>

            <div class="text-center">
                <div class="w-32 h-32 mx-auto mb-4 rounded-full overflow-hidden shadow-lg">
                    <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                </div>
                <h3 class="font-bold text-lg">Capitaine</h3>
                <p class="text-primary-red font-medium">M. [Nom du Capitaine]</p>
                <p class="text-gray-500 text-sm mt-1">Leader sur le terrain</p>
            </div>
        </div>
    </div>
</div>

<!-- Call to Action -->
<div class="bg-primary-dark text-white py-16">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Rejoignez l'aventure ASC Disso</h2>
        <p class="opacity-75 mb-8 max-w-2xl mx-auto text-lg">
            Soutenez votre équipe en achetant nos produits officiels. Chaque achat contribue au développement du club et de nos jeunes talents.
        </p>
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="{{ route('home') }}" class="bg-white text-primary-dark px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition shadow-lg">
                🛍️ Découvrir la boutique
            </a>
            <a href="{{ route('contact') }}" class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:text-gray-800 transition">
                📞 Nous contacter
            </a>
        </div>
    </div>
</div>
</div>
@endsection