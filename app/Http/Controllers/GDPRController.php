<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;
use App\User;
use App\UserStat;
use App\Page;
use App\Conversation;

class GDPRController extends Controller {

    public function index() {
        $title = 'GDPR - Δικαιώματα';
        $page = Page::find(4);

        return view('gdpr.index', ['title' => $title, 'page' => $page]);
    }

    public function rightToBeInformed() {
        $page = Page::findOrFail(3);
        $title = 'GDPR - Δικαίωμα ενημέρωσης (Right to be miniteacher.basic-informed)';

        return view('gdpr.right-to-be-informed', ['page' => $page, 'title' => $title]);
    }

    public function rightOfAccess() {
        $user = User::findOrFail(Auth::user()->id);
        $title = 'GDPR - Δικαίωμα πρόβασης (Right of access)';

        return view('gdpr.right-of-access', ['user' => $user, 'title' => $title]);
    }

    public function exportData() {
        $user = User::findOrFail(Auth::user()->id);

        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=data.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $callback = function() use ($user) {
            $file = fopen('php://output', 'w');

            fputcsv($file, array('GDPR - Δικαίωμα πρόσβασης : ' . Carbon::now()));

            // Basic miniteacher.basic-info
            fputcsv($file, array('Βασικά στοιχεία'));
            fputcsv($file, array('Id χρήστη', 'Τύπος χρήστη', 'Φύλο', 'Email', 'Επιβεβαιωμένο προφίλ', 'Όνομα', 'Ημ/νία γέννησης', 'Τελευταία είσοδος', 'Εικόνα', 'Ημ/νία δημιουργίας', 'Ημ/νία τελευταίας τροποποποίησης'));
            fputcsv($file, array($user->id, $user->userType->name, $user->gender->name, $user->email, $user->confirmed, $user->name, $user->birthdate, $user->login_date, $user->picture, $user->created_at, $user->updated_at));

            // Stats
            fputcsv($file, array('Επιπλέον στοιχεία'));
            fputcsv($file, array('Εμπειρία', 'Επίπεδο', 'Τιμή ανά ώρα', 'Σημερινές προβολές', 'Συνολικές προβολές', 'Πόντοι', 'Δημοσιευμένο προφίλ', 'Ημ/νία δημιουργίας', 'Ημ/νία τελευταίας τροποποίησης'));

            // Extra miniteacher.basic-info
            fputcsv($file, array('Επιπλέον πληροφορίες (ελεύθερο κείμενο'));
            fputcsv($file, array('Id πληροφορίας', 'Τίτλος', 'Περιεχόμενο', 'Ημ/νία δημιουργίας', 'Ημ/νία τελευταίας τροποποίησης'));
            foreach ($user->extras as $extra) {
                fputcsv($file, array($extra->id, $extra->description, $extra->pivot->content, $extra->pivot->created_at, $extra->pivot->updated_at));
            }

            // Courses
            fputcsv($file, array('Μαθήματα που διδάσκω'));
            fputcsv($file, array('Id μαθήματος', 'Μάθημα', 'Ημ/νία δημιουργίας', 'Ημ/νία τελευταίας τροποποίησης'));
            foreach ($user->courses as $course) {
                fputcsv($file, array($course->id, $course->name, $course->pivot->created_at, $course->pivot->updated_at));
            }

            // Target Groups
            fputcsv($file, array('Ομάδες που διδάσκω'));
            fputcsv($file, array('Id ομάδας', 'Ομάδα', 'Ημ/νία δημιουργίας', 'Ημ/νία τελευταίας τροποποίησης'));
            foreach ($user->targetGroups as $targetGroup) {
                fputcsv($file, array($targetGroup->id, $targetGroup->name, $targetGroup->pivot->created_at, $targetGroup->pivot->updated_at));
            }

            // Municipalities
            fputcsv($file, array('Δήμοι που διδάσκω'));
            fputcsv($file, array('Id Δήμου', 'Δήμος', 'Περιφερειακή Ενότητα', 'Περιφέρεια', 'Ημ/νία δημιουργίας', 'Ημ/νία τελευταίας τροποποίησης'));
            foreach ($user->municipalities as $municipality) {
                fputcsv($file, array($municipality->id, $municipality->name, $municipality->regionalUnit->name, $municipality->regionalUnit->region->name, $municipality->pivot->created_at, $municipality->pivot->updated_at));
            }

            // Services
            fputcsv($file, array('Υπηρεσίες που προσφέρω'));
            fputcsv($file, array('Id Υπηρεσίας', 'Υπηρεσία', 'Ημ/νία δημιουργίας', 'Ημ/νία τελευταίας τροποποίησης'));
            foreach ($user->services as $service) {
                fputcsv($file, array($service->id, $service->name, $service->pivot->created_at, $service->pivot->updated_at));
            }

            // Departments
            fputcsv($file, array('Προπτυχιακές σπουδές'));
            fputcsv($file, array('Id Τμήματος', 'Τμήμα', 'Σχολή', 'Εκπαιδευτικό Ίδρυμα', 'Έτος αποφοίτησης', 'Ημ/νία δημιουργίας', 'Ημ/νία τελευταίας τροποποίησης'));
            foreach ($user->departments as $department) {
                fputcsv($file, array($department->id, $department->name, $department->school->name, $department->school->institution->name, $department->pivot->endyear, $department->pivot->created_at, $department->pivot->updated_at));
            }

            // Postgraduates
            fputcsv($file, array('Μεταπτυχιακές σπουδές'));
            fputcsv($file, array('Id μεταπτυχιακού', 'Τίτλος', 'Έτος αποφοίτησης', 'Ημ/νία δημιουργίας', 'Ημ/νία τελευταίας τροποποίησης'));
            foreach ($user->postgraduates as $postgraduate) {
                fputcsv($file, array($postgraduate->id, $postgraduate->name, $postgraduate->endyear, $postgraduate->created_at, $postgraduate->updated_at));
            }

            // Phds
            fputcsv($file, array('Διδακτορικές σπουδές'));
            fputcsv($file, array('Id διατριβής', 'Τίτλος', 'Έτος αποφοίτησης', 'Ημ/νία δημιουργίας', 'Ημ/νία τελευταίας τροποποίησης'));
            foreach ($user->phds as $phd) {
                fputcsv($file, array($phd->id, $phd->name, $phd->endyear, $phd->created_at, $phd->updated_at));
            }

            // Websites
            fputcsv($file, array('Ιστοσελίδες'));
            fputcsv($file, array('Id ιστοσελίδας', 'Ιστοσελίδα', 'Μορφή ιστοσελίδας', 'Σύνδεσμος', 'Ημ/νία δημιουργίας', 'Ημ/νία τελευταίας τροποποίησης'));
            foreach ($user->websites as $website) {
                $url = str_replace('[value]', $website->pivot->value, $website->url_pattern);

                fputcsv($file, array($website->id, $website->name, $website->url_pattern, $url, $website->pivot->created_at, $website->pivot->updated_at));
            }

            // Adjectives
            fputcsv($file, array('Στοιχεία χαρακτήρα'));
            fputcsv($file, array('Id στοιχείου χαρακτήρα', 'Στοιχείο χαρακτήρα', 'Περιγραφή στοιχείου χαρακτηρα', 'Ημ/νία δημιουργίας', 'Ημ/νία τελευταίας τροποποίησης'));
            foreach ($user->adjectives as $adjective) {
                fputcsv($file, array($adjective->id, $user->id_gender == \App\Gender::MALE ? $adjective->name_male : $adjective->name_female, $user->id_gender == \App\Gender::MALE ? $adjective->description_male : $adjective->description_female, $adjective->pivot->created_at, $adjective->pivot->updated_at));
            }

            // Conversations
            fputcsv($file, array('Συζητήσεις'));
            fputcsv($file, array('Id συζήτησης', 'Id χρήστη που άνοιξε τη συζήτηση', 'Όνομα χρήστη που άνοιξε τη συζήτηση', 'Συμμετέχοντες', 'Ημ/νία δημιουργίας', 'Ημ/νία τελευταίας τροποποίησης'));
            foreach ($user->conversations as $conversation) {
                $participants = "";
                foreach ($conversation->users as $participant) {
                    $participants .= $participant->name . "|";
                }
                fputcsv($file, array($conversation->id, $conversation->user->id, $conversation->user->name, $participants, $conversation->created_at, $conversation->updated_at));
            }

            // Messages
            fputcsv($file, array('Μηνύματα'));
            fputcsv($file, array('Id μηνύματος', 'Id συζήτησης', 'Id αποστολέα', 'Όνομα αποστολέα', 'Περιεχόμενο', 'Ημ/νία δημιουργίας', 'Ημ/νία τελευταίας τροποποίησης'));
            foreach ($user->conversations as $conversation) {
                foreach ($conversation->messages as $message) {
                    fputcsv($file, array($message->id, $message->id_conversation, $message->user->id, $message->user->name, $message->content, $message->created_at, $message->updated_at));
                }
            }

            // User Actions
            fputcsv($file, array('Ιστορρικό ενεργειών που δίνουν minipoints'));
            fputcsv($file, array('Id εγγραφής ιστορικού ενεργειών', 'Id ενέργειας', 'Περιγραφή ενέργειας', 'Όνομα εμπλεκόμενου χρήστη', 'minipoints', 'Ημ/νία δημιουργίας', 'Ημ/νία τελευταίας τροποποίησης'));
            foreach ($user->userActions as $userAction) {
                fputcsv($file, array($userAction->id, $userAction->action->id, $userAction->action->name, (!empty($userAction->otherUser) ? $userAction->otherUser->name : '-'), $userAction->action->points, $userAction->created_at, $userAction->updated_at));
            }
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    public function rightToBeForgotten() {
        $user = User::findOrFail(Auth::user()->id);
        $user->delete();

		$userStat = UserStat::findOrFail(Auth::user()->id);
		$userStat->delete();

        Auth::logout();
        return redirect()->route('home');
    }

}
