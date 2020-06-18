var select_id = document.getElementById('select_pays');
var tab = ['Afghanistan', 'Afrique du Sud', 'Albanie', 'Algérie', 'Allemagne', 'Andorre', 'Angola',  'Antigua-et-Barbuda', 'Arabie saoudite', 'Argentine', 'Arménie', 'Australie', 'Autriche',  'Azerbaïdjan', 'Bahamas', 'Bahreïn', 'Bangladesh', 'Barbade', 'Belgique', 'Belize', 'Bénin', 'Bhoutan', 'Biélorussie',  'Birmanie', 'Bolivie', 'Bosnie-Herzégovine', 'Botswana', 'Brésil', 'Brunei', 'Bulgarie', 'Burkina Faso', 'Burundi', 'Cambodge', 'Cameroun', 'Canada', 'Cap-Vert', 'République centrafricaine', 'Chili', 'Chine', 'Chypre', 'Colombie', 'Comores', 'République du Congo', 'République démocratique du Congo', 'Îles Cook', 'Corée du Nord', 'Corée du Sud', 'Costa Rica', 'Côte d’Ivoire',  'Croatie', 'Cuba', 'Danemark',  'Djibouti', 'République dominicaine', 'Dominique', 'Égypte', 'Émirats arabes unis', 'Équateur', 'Érythrée', 'Espagne', 'Estonie', 'États-Unis', 'Éthiopie', 'Fidji', 'Finlande', 'France', 'Gabon', 'Gambie', 'Géorgie', 'Ghana', 'Grèce', 'Grenade', 'Guatemala', 'Guinée', 'Guinée-Bissau', 'Guinée équatoriale', 'Guyana', 'Haïti', 'Honduras', 'Hongrie', 'Inde', 'Indonésie', 'Irak', 'Iran', 'Irlande', 'Islande', 'Israël', 'Italie', 'Jamaïque', 'Japon', 'Jordanie', 'Kazakhstan', 'Kenya', 'Kirghizistan', 'Kiribati', 'Koweït', 'Laos', 'Lesotho', 'Lettonie', 'Liban', 'Liberia', 'Libye', 'Liechtenstein', 'Lituanie', 'Luxembourg', 'Macédoine du Nord', 'Madagascar', 'Malaisie', ' Malawi', 'Maldives', 'Mali', 'Malte', 'Maroc', 'Îles Marshall', 'Maurice', 'Mauritanie', 'Mexique', 'Micronésie', 'Moldavie', 'Monaco', 'Mongolie', 'Monténégro', 'Mozambique', 'Namibie', 'Nauru', ' Népal', 'Nicaragua', 'Niger', ' Nigeria', 'Niue', 'Norvège', 'Nouvelle-Zélande', 'Oman', 'Ouganda', 'Ouzbékistan', 'Pakistan', 'Palaos', 'Palestine', 'Panamá', 'Papouasie-Nouvelle-Guinée', 'Paraguay', ' Pays-Bas', 'Pérou', 'Philippines', 'Pologne', 'Portugal', ' Qatar', 'Roumanie', 'Royaume-Uni', 'Russie', 'Rwanda', 'Saint-Christophe-et-Niévès', 'Saint-Marin', 'Saint-Vincent-et-les Grenadines', ' Sainte-Lucie', ' Îles Salomon', 'Salvador', 'Samoa', ' São Tomé-et-Principe', 'Sénégal', ' Serbie', 'Seychelles', 'Sierra Leone', 'Singapour', 'Slovaquie', ' Slovénie', 'Somalie', 'Soudan', 'Soudan du Sud', 'Sri Lanka', 'Suède', 'Suisse', 'Suriname', ' Eswatini', 'Syrie', 'Tadjikistan', 'Tanzanie', ' Tchad', 'République tchèque', 'Thaïlande', 'Timor oriental', 'Togo', 'Tonga', 'Trinité-et-Tobago', 'Tunisie', ' Turkménistan', 'Turquie', 'Tuvalu', 'Ukraine', 'Uruguay', 'Vanuatu', 'Vatican', 'Venezuela', 'Viêt Nam', 'Yémen', 'Zambie', 'Zimbabwe', 'Abkhazie', 'Chypre du Nord', 'Kosovo', ' Ossétie du Sud', 'Sahara occidental', 'Taïwan', 'Hong Kong'];
for (var i = 0; i <tab.length; i++){
    var option_pays = document.createElement('option');
    option_pays.value = tab[i];
    option_pays.innerHTML += tab[i];
    select_id.appendChild(option_pays);
}
