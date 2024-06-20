class Person {
  final String nom;
  final String prenom;
  final List<String> departements;
  final Map<String, dynamic> links;

  Person({
    required this.nom,
    required this.prenom,
    required this.departements,
    required this.links,
  });
  

  factory Person.fromJson(Map<String, dynamic> json) {
    
    return Person(
      nom: json['nom'],
      prenom: json['prenom'],
      departements: List<String>.from(json['departements']),
      links: json['links'],
    );
  }
}
