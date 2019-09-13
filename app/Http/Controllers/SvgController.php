<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\User;
use App\UserType;

class SvgController extends Controller {

    private $user;

    public function show($id) {
        $this->user = User::findOrFail($id);

        $rand = rand(1, 6);
        $isTeacher = $this->user->id_user_type == UserType::TEACHER;
        // $rand = 5;
        switch ($rand) {
            // Course
            case 1:
                if (count($this->user->courses) > 0) {
                    $course = $this->user->courses()->first();

                    if ($isTeacher) {
                        $response = $this->createSVGResponse("Μαζί θα κάνουμε", "το μάθημα...", "..." . $course->name . ".");
                    } else {
                        $response = $this->createSVGResponse("Με ενδιαφέρει", "το μάθημα...", "..." . $course->name . ".");
                    }
                } else {
                    $response = $this->createSVGResponse("", "", "");
                }
                break;

            // Department
            case 2:
                if (count($this->user->departments) > 0) {
                    $department = $this->user->departments()->first();

                    if ($isTeacher) {
                        $response = $this->createSVGResponse("Έχω πτυχίο από", $department->school->institution->name . "...", "..." . $department->name . ".");
                    } else {
                        $response = $this->createSVGResponse("Με ενδιαφέρει κάποιος με πτυχίο από", $department->school->institution->name . "...", "..." . $department->name . ".");
                    }
                } else {
                    $response = $this->createSVGResponse("", "", "");
                }
                break;

            // Postgraduate
            case 3:
                if (count($this->user->postgraduates) > 0) {
                    $postgraduate = $this->user->postgraduates()->first();

                    if ($isTeacher) {
                        $response = $this->createSVGResponse("Έχω μεταπτυχιακό", "με θέμα...", "..." . $postgraduate->name . ".");
                    } else {
                        $response = $this->createSVGResponse("Με ενδιαφέρει κάποιος", "με μεταπτυχιακό με θέμα...", "..." . $postgraduate->name . ".");
                    }
                } else {
                    $response = $this->createSVGResponse("", "", "");
                }
                break;

            // PhD
            case 4:
                if (count($this->user->phds) > 0) {
                    $phd = $this->user->phds()->first();

                    if ($isTeacher) {
                        $response = $this->createSVGResponse("Έχω διδακτορικό", "με θέμα...", "..." . $phd->name . ".");
                    } else {
                        $response = $this->createSVGResponse("Με ενδιαφέρει κάποιος", "με διδακτορικό με θέμα...", "..." . $phd->name . ".");
                    }
                } else {
                    $response = $this->createSVGResponse("", "", "");
                }
                break;

            // Service
            case 5:
                if (count($this->user->services) > 0) {
                    $service = $this->user->services()->first();

                    if ($isTeacher) {
                        $response = $this->createSVGResponse("Μία από τις υπηρεσίες", "που παρέχω είναι...", "..." . $service->name . ".");
                    } else {
                        $response = $this->createSVGResponse("Με ενδιαφέρει κάποιος", "που να παρέχει...", "..." . $service->name . ".");
                    }
                } else {
                    $response = $this->createSVGResponse("", "", "");
                }
                break;

            default:
                $response = $this->createSVGResponse("", "", "");
                break;
        }

        return $response;
    }

    private function createSVGResponse($text1, $text2, $text3) {
        $svg = File::get('svg/usertypes/main-' . $this->user->userType->id . '-' . $this->user->gender->id . '.svg');


        if ($text1 == "" && $text2 == "" && $text3 == "") {
            if ($this->user->id_user_type == UserType::TEACHER) {
                $text1 = 'Καλησπέρα, παιδιά';
                $text2 = 'το όνομά μου είναι...';
                $text3 = '...' . $this->user->name . ".";
            } else {
                $text1 = 'Το όνομά μου είναι...';
                $text2 = '';
                $text3 = '...' . $this->user->name . ".";
            }
        }
        $svg = str_replace("[text1]", $text1, $svg);
        $svg = str_replace("[text2]", $text2, $svg);
        $svg = str_replace("[text3]", $text3, $svg);

        return response($svg)->withHeaders(['Content-Type' => 'image/svg+xml']);
    }

}
