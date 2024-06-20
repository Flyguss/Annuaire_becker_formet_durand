import 'package:dio/dio.dart';
import '../models/person.dart';
import 'dart:io' show Platform;
import 'package:flutter/foundation.dart';

class ApiService {
  static Future<List<Person>> fetchPersonsApi() async {
  try {
    var response = await Dio().get("http://localhost:42064/api/entrees");
    if (response.statusCode == 200) {
      List<dynamic>? entries = response.data['entres'];

      // Vérifiez que entries n'est pas null
      if (entries == null) {
        throw Exception("Les entrées sont nulles");
      }

      // Créer une liste de futures
      List<Future<Person>> personFutures = entries.map((person) async {
        // Vérifiez que 'links' et 'href' existent dans chaque entrée
        if (person['links'] == null || person['links']['href'] == null) {
          throw Exception("Lien non trouvé dans l'entrée");
        }

        var detailResponse = await Dio().get("http://localhost:42064${person['links']['href']}");
        if (detailResponse.statusCode == 200) {
          var p = detailResponse.data['entre'];
          // Vérifiez que 'entre' n'est pas null
          if (p == null) {
            throw Exception("Détails de l'entrée non trouvés");
          }
          return Person.fromJson(p);
        } else {
          throw Exception('Erreur lors de la récupération des détails: ${detailResponse.statusCode}');
        }
      }).toList();

      // Attendre que toutes les futures soient terminées
      List<Person> persons = await Future.wait(personFutures);

      return persons;
    } else {
      if (kDebugMode) {
        print('Erreur lors de la récupération des entrées: ${response.statusCode}');
      }
      throw Exception("Impossible de lire les données de l'API - erreur");
    }
  } catch (e) {
    if (kDebugMode) {
      print(e);
    }
    throw Exception("Impossible de lire les données de l'API");
  }
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
