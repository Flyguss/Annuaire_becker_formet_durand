import 'package:flutter/material.dart';
import '../models/person.dart';
import 'package:url_launcher/url_launcher.dart';

class PersonDetailScreen extends StatelessWidget {
  final Person person;

  const PersonDetailScreen({Key? key, required this.person}) : super(key: key);

  void _launchPhone(String phoneNumber) async {
    final telUrl = 'tel:$phoneNumber';
    if (await canLaunch(telUrl)) {
      await launch(telUrl);
    } else {
      throw 'Could not launch $telUrl';
    }
  }

  void _launchEmail(String email) async {
    final mailUrl = 'mailto:$email';
    if (await canLaunch(mailUrl)) {
      await launch(mailUrl);
    } else {
      throw 'Could not launch $mailUrl';
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
            Text('Department: ${person.departements.join(', ')}'),
            SizedBox(height: 16),
            if (person.numeroTelephone.isNotEmpty)
              ElevatedButton(
                onPressed: () => _launchPhone(person.numeroTelephone),
                child: Text('Appeler: ${person.numeroTelephone}'),
              ),
            SizedBox(height: 16),
            if (person.numeroTelephoneBureau.isNotEmpty)
              ElevatedButton(
                onPressed: () => _launchPhone(person.numeroTelephoneBureau),
                child: Text('Appeler Bureau: ${person.numeroTelephoneBureau}'),
              ),
            SizedBox(height: 16),
            if (person.email.isNotEmpty)
              ElevatedButton(
                onPressed: () => _launchEmail(person.email),
                child: Text('Email: ${person.email}'),
              ),
            SizedBox(height: 16),
            if (person.img.isNotEmpty)
              Image.asset(
                'image/${person.img}',
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
