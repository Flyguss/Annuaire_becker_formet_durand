class Person {
  final String nom;
  final String prenom;
  final List<String> departements;
  final String numeroTelephone;
  final String numeroTelephoneBureau;
  final String fonction;
  final String email;
  final String img;
  final Map<String, dynamic> links;

  Person({
    required this.nom,
    required this.prenom,
    required this.departements,
    required this.numeroTelephone,
    required this.numeroTelephoneBureau,
    required this.fonction,
    required this.email,
    required this.img,
    required this.links,
  });

  factory Person.fromJson(Map<String, dynamic> json) {
    return Person(
      nom: json['nom'],
      prenom: json['prenom'],
      departements: List<String>.from(json['departements']),
      numeroTelephone: json['NuméroTelephone'],
      numeroTelephoneBureau: json['NuméroTelephoneBureau'],
      fonction: json['Fonction'],
      email: json['email'],
      img: json['img'],
      links: json['links'] ?? {}, // Ajout de vérification pour 'links'
    );
  }
}
