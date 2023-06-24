<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Repository\ContactRepository;

class ContactController extends Controller {
    public function route() :void {

        try {
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'list':
                        $this->list();
                    break;
                    case 'show':
                        $this->show();
                    break;
                    case 'delete':
                        $this->delete();
                    break;
                    case 'update':
                        $this->update();
                    break;
                    case 'create':
                        $this->create();
                    break;
                    default:
                        throw new \Exception('L\'action '.$_GET['action'].' n\'existe pas');
                    break;
                }
            } else {
                //si pas d'argument on charge la page d'accueil
                $pageController = new HomeController();
                $pageController->route();
            }        
        } catch (\Exception $e) {
            $this->render('/templates/error.php', [
                'error'=> $e->getMessage(),
            ]);
        }       
    }

    protected function list() {
        $contactRepository = new ContactRepository;
        $contacts = $contactRepository->findAll();

        $params = [
            'contacts' => $contacts
        ];

        $this->render('/templates/contact/list.php', $params);
    }

    protected function show() {
        try {
            if(isset($_GET['id'])) {

                $id = (int)$_GET['id'];
                
                $contactRepository = new ContactRepository;
                $contact = $contactRepository->findOneById($id);

                $params = [
                    'contact'=>$contact,
                ];
        
                $this->render('/templates/contact/show.php', $params);

            } else {
                throw new \Exception('id introuvable');
            }
        } catch (\Exception $e) {
            $this->render('/templates/error.php', [
                'error'=> $e->getMessage(),
            ]);
        }
    }

    protected function delete() {
        try {
            if(isset($_GET['id'])) {

                $id = (int)$_GET['id'];
                
                $contactRepository = new ContactRepository;
                $contactRepository->delete($id);
                $this->list();

            } else {
                throw new \Exception('id introuvable');
            }
        } catch (\Exception $e) {
            $this->render('/templates/error.php', [
                'error'=> $e->getMessage(),
            ]);
        }
    }

    protected function update()
    {
        try {
            if (isset($_GET['id'])) {
                $id = (int)$_GET['id'];
                
                $contactRepository = new ContactRepository;
                $contact = $contactRepository->findOneById($id); // Récupère la cible

                if (!$contact) {
                    throw new \Exception('Cible introuvable');
                }

                if (isset($_POST['contactId'])) {
                    // Met à jour les propriétés de la cible avec les valeurs du formulaire
                    $contact->setFirstName($_POST['firstName']);
                    $contact->setLastName($_POST['lastName']);
                    $contact->setBirthDate(new \DateTime($_POST['birthDate']));
                    $contact->setCode((int)$_POST['code']);
                    $contact->setNationality($_POST['nationality']);

                    $contactRepository->update($contact); // Met à jour la cible avec les nouvelles valeurs

                    $this->list();
                    return;
                }

                $params = [
                    'contact' => $contact,
                ];

                $this->render('/templates/contact/update.php', $params);
            } else {
                throw new \Exception('ID introuvable');
            }
        } catch (\Exception $e) {
            $this->render('/templates/error.php', [
                'error' => $e->getMessage(),
            ]);
        }
    }


    protected function create() {
        
        try {
            if (isset($_POST['createContact'])) {
                
                
                $contact = new Contact;

                
                // Met à jour les propriétés de la cible avec les valeurs du formulaire
                $contact->setFirstName($_POST['firstName']);
                $contact->setLastName($_POST['lastName']);
                $contact->setBirthDate(new \DateTime($_POST['birthDate']));
                $contact->setCode((int)$_POST['code']);
                $contact->setNationality($_POST['nationality']);
                
                $contactRepository = new ContactRepository;
                $contactRepository->create($contact);
                
                return $this->list();;

            } else {
                $this->render('/templates/contact/create.php');
            }
        } catch (\Exception $e) {
            $this->render('/templates/error.php', [
                'error' => $e->getMessage(),
            ]);
        }
    }

}