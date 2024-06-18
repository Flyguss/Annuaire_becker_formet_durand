import 'package:flutter/material.dart';
import '../models/person.dart';
import 'package:url_launcher/url_launcher.dart';

class PersonDetailScreen extends StatelessWidget {
  final Person person;

  const PersonDetailScreen({Key? key, required this.person}) : super(key: key);

  void _launchEmail(String email) async {
    if (await canLaunch('mailto:$email')) {
      await launch('mailto:$email');
    } else {
      throw 'Could not launch email';
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Person Detail'),
      ),
      body: Padding(
        padding: EdgeInsets.all(16.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: <Widget>[
            Text(
              '${person.nom} ${person.prenom}',
              style: TextStyle(fontSize: 24, fontWeight: FontWeight.bold),
            ),
            SizedBox(height: 8),
            Text('Department: ${person.departements}'),
            SizedBox(height: 16),
            if (person.links.containsKey('email'))
              ElevatedButton(
                onPressed: () => _launchEmail(person.links['email']),
                child: Text('Email: ${person.links['email']}'),
              ),
            SizedBox(height: 16),
            if (person.links.containsKey('img'))
              Image.asset(
                'image/${person.links['img']}',
                height: 200, // Ajustez la hauteur selon vos besoins
                width: double.infinity, // Prend toute la largeur disponible
                fit: BoxFit.scaleDown, // Ajuste l'image pour couvrir la boîte
              ),
            SizedBox(height: 16),
            // Ajoutez d'autres informations si nécessaire
          ],
        ),
      ),
    );
  }
}
