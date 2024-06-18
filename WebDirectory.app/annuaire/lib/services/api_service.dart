import 'package:dio/dio.dart';
import '../models/person.dart';
import 'dart:io' show Platform;
import 'package:flutter/foundation.dart';

class ApiService {
  static Future<List<Person>> fetchPersonsApi() async {
    try {
         

      final response = await Dio().get(
        "http://localhost:42064/api/entrees",);
      if (response.statusCode == 200) {
         List<dynamic> entries = response.data['entres'];

        // Mapper chaque élément de 'entres' en tant qu'objet Person
        List<Person> persons = entries.map((json) => Person.fromJson(json)).toList();
        
        return persons;
      } else {
        if (kDebugMode) {
          print(response.statusCode);
        }
        throw Exception("Can't read data from API - erreur");
      }
    } catch (e) {
      if (kDebugMode) {
        print(e);
      }

      throw Exception("Can't read data from API");
    }
  }


  static Future<List<Person>> fetchPersonsFaker() async {
    // Simulate an asynchronous request (e.g., to an API)
    await Future.delayed(Duration(seconds: 1));

    // Example of simulated data for multiple persons
    List<Map<String, dynamic>> simulatedPersons = [
      {
        'nom': 'Doe',
        'prenom': 'John',
        'departements': ['Informatique', 'Marketing'],
        'links': {
          'siteWeb': 'https://example.com',
          'github': 'https://github.com/example',
          'twitter': 'https://twitter.com/example',
        },
      },
      {
        'nom': 'Smith',
        'prenom': 'Jane',
        'departements': ['Ressources humaines', 'Finance'],
        'links': {
          'siteWeb': 'https://smithcorp.com',
          'linkedin': 'https://linkedin.com/janesmith',
        },
      },
      // Add more simulated persons here if necessary
    ];

    // Create the list of Person objects
    List<Person> persons = simulatedPersons.map((data) {
      return Person(
        nom: data['nom'],
        prenom: data['prenom'],
        departements: List<String>.from(data['departements']),
        links: Map<String, dynamic>.from(data['links']),
      );
    }).toList();

    return persons;
  }
}

String getLocalhostAccordingToPlatform() {
  String host = "127.0.0.1";
  try {
    if (Platform.isAndroid) {
      host = '10.0.2.2';
    } else if (Platform.isIOS) {
      host = '0.0.0.0';
    } else if (Platform.isLinux) {
      host = "127.0.0.1";
    } else if (Platform.isFuchsia) {
      host = "127.0.0.1";
    } else if (Platform.isMacOS) {
      host = "localhost";
    } else if (Platform.isWindows) {
      host = "127.0.0.1";
    }
  } catch (e) {
    if (kDebugMode) {
      print(e);
    }
    //Platform = web
    host = "0.0.0.0";
  }

  return host;
}
