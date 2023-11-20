<?php

namespace App\Http\Controllers;

class screenIXSrce extends Controller
{
    public function __construct()
    {
    }
    public function BMI($Age, $Gender, $Weight, $Height)
    {
        if ($Age >= 30 and $Age <= 75) {
            $bmi = $Weight * 10000 / ($Height * $Height) - ($Age - 30) / 10;
        } else if ($Age > 0 and $Age < 30) {
            $bmi = $Weight * 10000 / ($Weight * $Height);
        } else if ($Age > 75) {
            $bmi = 100;
        }
        if ($bmi != 100) {
            if ($Gender == 1) {
                if ($bmi < 19.5) {
                    $risk_bmi = 0.25;
                    $quality_bmi = 0.75;
                } else if ($bmi >= 19.5 and $bmi < 25) {
                    $risk_bmi = 0.05;
                    $quality_bmi = 0.95;
                } else if ($bmi >= 25 and $bmi < 30) {
                    $risk_bmi = 0.23;
                    $quality_bmi = 0.77;
                } else if ($bmi >= 30 and $bmi < 32) {
                    $risk_bmi = 0.38;
                    $quality_bmi = 0.62;
                } else if ($bmi >= 32) {
                    $risk_bmi = 0.49;
                    $quality_bmi = 0.51;
                }
            } else {
                if ($bmi < 18.5) {
                    $risk_bmi = 0.25;
                    $quality_bmi = 0.75;
                } else if ($bmi >= 19.5 and $bmi < 25) {
                    $risk_bmi = 0.05;
                    $quality_bmi = 0.95;
                } else if ($bmi >= 25 and $bmi < 30) {
                    $risk_bmi = 0.2;
                    $quality_bmi = 0.8;
                } else if ($bmi >= 30 and $bmi < 32) {
                    $risk_bmi = 0.35;
                    $quality_bmi = 0.65;
                } else if ($bmi >= 32) {
                    $risk_bmi = 0.45;
                    $quality_bmi = 0.55;
                }
            }
        } else {
            $risk_bmi = 1;
            $quality_bmi = 1;
        }
        return $risk_bmi;
    }
    function idealnaTezina($gender, $weight, $height, $age)
    {
        if ($gender == 1) {
            $iw = $height - 100.0 - ($height - 150) / 4 + ($age - 20) / 4;
        } else {
            $iw = $height - 100.0 - ($height - 150) / 2.5 + ($age - 20) / 4;
        }
        $ow = $weight / ($height - 105);
        if ($ow > 0 and $ow <= 0.8) {
            $risk_iw = 0.2;
            $quality_iw = 0.8;
        } else if ($ow > 0.8 and $ow <= 0.9) {
            $risk_iw = 0.1;
            $quality_iw = 0.9;
        } else if ($ow > 0.9 and $ow <= 1.0) {
            $risk_iw = 0.01;
            $quality_iw = 0.99;
        } else if ($ow > 1.0 and $ow <= 1.1) {
            $risk_iw = 0.3;
            $quality_iw = 0.7;
        } else if ($ow > 1.1 and $ow <= 1.3) {
            $risk_iw = 0.45;
            $quality_iw = 0.55;
        } else {
            $risk_iw = 0.65;
            $quality_iw = 0.35;
        }
        if ($weight - $iw > 0) {
            $diff = $weight - $iw;
        } else {
            $diff = $weight - $iw;
        }
        if ($diff < 5) {
            $risk_iw = $risk_iw * 0.5;
            $quality_iw = $quality_iw * 1.35;
        } else if ($diff >= 5 and $diff < 8.5) {
            $risk_iw = $risk_iw * 1.2;
            $quality_iw = $quality_iw * 0.9;
        } else if ($diff >= 8.5 and $diff < 12.5) {
            $risk_iw = $risk_iw * 1.35;
            $quality_iw = $quality_iw * 0.84;
        } else {
            $risk_iw = $risk_iw * 1.65;
            $quality_iw = $quality_iw * 0.45;
        }
        return $risk_iw;
    }
    public function riskKorak1($age, $gender, $weight, $height)
    {
        $bmiRisk = $this->BMI($age, $gender, $weight, $height);
        $idealRisk = $this->idealnaTezina($gender, $weight, $height, $age);

        return (int) (((3.5 * $bmiRisk + 2 * $idealRisk) / 5.5) * 100);
    }
    function pressImportant($dijastolni, $sistolni)
    {
        $quality_F10 = 100;
        $s = $sistolni;
        $d = $dijastolni;
        if ($s != -2 && $d != -2) {
            if ($s > 140 && $d < 90) {
                $risk_important = 0.45;
                $quality_important = 0.55;
            } else if ($s - $d >= 50) {
                $risk_important = 0.4;
                $quality_important = 0.6;
            } else if ($s - $d <= 15) {
                $risk_important = 0.35;
                $quality_important = 0.65;
            } else {
                $risk_important = 0.05;
                $quality_important = 0.95;
            }
        }
        $quality_F10 = $quality_F10 * $quality_important;
        return $risk_important;
    }
    function pressControle($age, $dijastolni, $sistolni)
    {
        $a = $age;
        $d = $dijastolni;
        $s = $sistolni;
        $quality_Press = 1;
        $risk_Press = 1;
        if ($s != -2 and $d != -2) {
            function diff($a, $b, $c, $d)
            {
                if ($a - $b >= 0) {
                    $k1 = $a - $b;
                } else {
                    $k1 = $b - $a;
                }
                if ($c - $d >= 0) {
                    $k2 = $c - $d;
                } else {
                    $k2 = $d - $d;
                }
                $dif = (float)($k1 + $k2) / 2.0;
                return $dif;
            }
            $rg = [[0, 1, 75, 50, 90, 60, 100, 75], [1, 5, 80, 55, 95, 65, 110, 79], [6, 13, 90, 60, 105, 70, 115, 80], [14, 19, 105, 73, 117, 77, 120, 81], [20, 24, 108, 75, 120, 79, 132, 83], [25, 29, 109, 76, 12, 80, 133, 84], [30, 34, 110, 77, 122, 81, 134, 85], [35, 39, 111, 78, 123, 82, 135, 86], [
                40, 44, 112, 79, 125, 83, 137, 87
            ], [45, 49, 115, 80, 127, 84, 139, 88], [50, 54, 116, 81, 129, 85, 142, 89], [55, 59, 118, 82, 131, 86, 144, 90], [60, 64, 121, 83, 134, 87, 147, 91], [65, 69, 122, 84, 136, 88, 149, 92], [70, 79, 125, 87, 139, 90, 151, 95], [80, 100, 127, 90, 141, 93, 153, 97]];
            # to 100 years old, over that "good life"
            foreach ($rg as $p) {
                if ($a >= $p[0] and $a <= $p[1]) {
                    if ($s - $d <= $p[6] - $p[3]) {
                        if ($s >= $p[2] and $s <= $p[6]) {
                            if ($d >= $p[3] and $d <= $p[7]) {
                                if (diff($s, $p[4], $d, $p[5]) > ($p[2] + $p[6]) / 4.0) {
                                    $risk_Press = 0.1;
                                    $quality_Press = 0.92;
                                } else {
                                    $risk_Press = 0.02;
                                    $quality_Press = 0.99;
                                }
                            } else {
                                $risk_Press = 0.25;
                                $quality_Press = 0.75;
                            }
                        } else {
                            if ($d >= $p[3] and $d <= $p[7]) {
                                $risk_Press = 0.2;
                                $quality_Press = 0.8;
                            } else {
                                $risk_Press = 0.4;
                                $quality_Press = 0.62;
                            }
                        }
                    } else {
                        if ($s < 150) {
                            $risk_Press = 0.5;
                            $quality_Press = 0.5;
                        } else {
                            $risk_Press = 0.65;
                            $quality_Press = 0.35;
                        }
                    }
                }
            }
            return $risk_Press;
        }
    }
    function Last($age, $last, $frequency)
    {
        $a = $age;
        $l = $last;
        $f = $frequency;
        $risk_Press = 1;
        if ($a >= 40 and $a < 50) {
            if ($l == -1) {
                $risk_last = 0.1;
                $quality_last = 0.9;
            } else if ($l <= 3) {
                if ($f >= 1 and $f <= 2) {
                    $risk_last = 0.3;
                    $quality_last = 0.75;
                } else if ($f < 1) {
                    $risk_last = 0.35;
                    $quality_last = 0.7;
                } else {
                    $risk_last = 0.4;
                    $quality_last = 0.65;
                }
            } else if ($l > 3 and $l <= 6) {
                if ($f >= 1 and $f <= 2) {
                    $risk_last = 0.25;
                    $quality_last = 0.85;
                } else if ($f < 1) {
                    $risk_last = 0.3;
                    $quality_last = 0.75;
                } else {
                    $risk_last = 0.35;
                    $quality_last = 0.7;
                }
            } else {
                if ($f >= 1 and $f <= 2) {
                    $risk_last = 0.22;
                    $quality_last = 0.83;
                } else if ($f < 1) {
                    $risk_last = 0.28;
                    $quality_last = 0.73;
                } else {
                    $risk_last = 0.38;
                    $quality_last = 0.68;
                }
            }
        } else if ($a >= 50 and $a < 60) {
            if ($l == -1) {
                $risk_last = 0.15;
                $quality_last = 0.85;
            } else if ($l <= 3) {
                if ($f >= 1 and $f <= 2) {
                    $risk_last = 0.4;
                    $quality_last = 0.65;
                } else if ($f < 1) {
                    $risk_last = 0.45;
                    $quality_last = 0.6;
                } else {
                    $risk_last = 0.5;
                    $quality_last = 0.55;
                }
            } else if ($l > 3 and $l <= 6) {
                if ($f >= 1 and $f <= 2) {
                    $risk_last = 0.35;
                    $quality_last = 0.75;
                } else if ($f < 1) {
                    $risk_last = 0.4;
                    $quality_last = 0.65;
                } else {
                    $risk_last = 0.45;
                    $quality_last = 0.6;
                }
            } else {
                if ($f >= 1 and $f <= 2) {
                    $risk_last = 0.32;
                    $quality_last = 0.73;
                } else if ($f < 1) {
                    $risk_last = 0.38;
                    $quality_last = 0.63;
                } else {
                    $risk_last = 0.48;
                    $quality_last = 0.58;
                }
            }
        } else if ($a >= 60 and $a < 70) {
            if ($l == -1) {
                $risk_last = 0.35;
                $quality_last = 0.65;
            } else if ($l <= 3) {
                if ($f >= 1 and $f <= 2) {
                    $risk_last = 0.5;
                    $quality_last = 0.55;
                } else if ($f < 1) {
                    $risk_last = 0.55;
                    $quality_last = 0.5;
                } else {
                    $risk_last = 0.6;
                    $quality_last = 0.45;
                }
            } else if ($l > 3 and $l <= 6) {
                if ($f >= 1 and $f <= 2) {
                    $risk_last = 0.45;
                    $quality_last = 0.65;
                } else if ($f < 1) {
                    $risk_last = 0.5;
                    $quality_last = 0.55;
                } else {
                    $risk_last = 0.55;
                    $quality_last = 0.5;
                }
            } else {
                if ($f >= 1 and $f <= 2) {
                    $risk_last = 0.42;
                    $quality_last = 0.63;
                } else if ($f < 1) {
                    $risk_last = 0.48;
                    $quality_last = 0.53;
                } else {
                    $risk_last = 0.58;
                    $quality_last = 0.48;
                }
            }
        } else if ($a >= 70) {
            if ($l == -1) {
                $risk_last = 0.45;
                $quality_last = 0.55;
            } else if ($l <= 3) {
                if ($f >= 1 and $f <= 2) {
                    $risk_last = 0.6;
                    $quality_last = 0.45;
                } else if ($f < 1) {
                    $risk_last = 0.65;
                    $quality_last = 0.4;
                } else {
                    $risk_last = 0.7;
                    $quality_last = 0.35;
                }
            } else if ($l > 3 and $l <= 6) {
                if ($f >= 1 and $f <= 2) {
                    $risk_last = 0.55;
                    $quality_last = 0.55;
                } else if ($f < 1) {
                    $risk_last = 0.6;
                    $quality_last = 0.45;
                } else {
                    $risk_last = 0.65;
                    $quality_last = 0.4;
                }
            } else {
                if ($f >= 1 and $f <= 2) {
                    $risk_last = 0.52;
                    $quality_last = 0.53;
                } else if ($f < 1) {
                    $risk_last = 0.58;
                    $quality_last = 0.43;
                } else {
                    $risk_last = 0.68;
                    $quality_last = 0.38;
                }
            }
        } else {
            if ($l == -1) {
                $risk_last = 0.01;
                $quality_last = 0.99;
            } else if ($l <= 3) {
                if ($f >= 1 and $f <= 2) {
                    $risk_last = 0.15;
                    $quality_last = 0.9;
                } else if ($f < 1) {
                    $risk_last = 0.2;
                    $quality_last = 0.85;
                } else {
                    $risk_last = 0.25;
                    $quality_last = 0.8;
                }
            } else if ($l > 3 and $l <= 6) {
                if ($f >= 1 and $f <= 2) {
                    $risk_last = 0.2;
                    $quality_last = 0.88;
                } else if ($f < 1) {
                    $risk_last = 0.25;
                    $quality_last = 0.8;
                } else {
                    $risk_last = 0.25;
                    $quality_last = 0.8;
                }
            } else {
                if ($f >= 1 and $f <= 2) {
                    $risk_last = 0.12;
                    $quality_last = 0.9;
                } else if ($f < 1) {
                    $risk_last = 0.18;
                    $quality_last = 0.83;
                } else {
                    $risk_last = 0.28;
                    $quality_last = 0.88;
                }
            }
        }
        return $risk_last;
    }
    function riskPressure($age, $dijastolni, $sistolni, $last, $frequency)
    {
        $control = $this->pressControle($age, $dijastolni, $sistolni);
        $important = $this->pressImportant($dijastolni, $sistolni);
        $last_f = $this->Last($age, $last, $frequency);

        return (int) (((5 * $control + 2 * $last_f + 4 * $important) / 11) * 100);
    }

    function qHabits1($q1)
    {
        if ($q1 != -1) {
            if ($q1 == 0) {
                $q1_risk = 0.01;
                $q1_quality = 0.99;
            } else if ($q1 == 1) {
                $q1_risk = 0.05;
                $q1_quality = 0.95;
            } else if ($q1 == 2) {
                $q1_risk = 0.1;
                $q1_quality = 0.9;
            } else if ($q1 == 3) {
                $q1_risk = 0.12;
                $q1_quality = 0.88;
            } else if ($q1 == 4) {
                $q1_risk = 0.25;
                $q1_quality = 0.75;
            } else if ($q1 == 5) {
                $q1_risk = 0.36;
                $q1_quality = 0.74;
            } else if ($q1 == 6) {
                $q1_risk = 0.3;
                $q1_quality = 0.7;
            } else if ($q1 == 7) {
                $q1_risk = 0.35;
                $q1_quality = 0.65;
            } else if ($q1 == 8) {
                $q1_risk = 0.4;
                $q1_quality = 0.6;
            } else if ($q1 == 9) {
                $q1_risk = 0.45;
                $q1_quality = 0.55;
            } else if ($q1 == 10) {
                $q1_risk = 0.55;
                $q1_quality = 0.45;
            } else if ($q1 == 11) {
                $q1_risk = 0.65;
                $q1_quality = 0.35;
            } else {
                $q1_risk = 0.75;
                $q1_quality = 0.25;
            }
        } else {
            $q1_risk = 1;
            $q1_quality = 1;
        }

        return $q1_risk;
    }
    function qHabits2($q2)
    {
        if ($q2 != -1) {
            if ($q2 == 0) {
                $q2_risk = 0.5;
                $q2_quality = 0.5;
            } else if ($q2 == 1) {
                $q2_risk = 0.35;
                $q2_quality = 0.65;
            } else if ($q2 == 2) {
                $q2_risk = 0.15;
                $q2_quality = 0.85;
            } else if ($q2 == 3) {
                $q2_risk = 0.05;
                $q2_quality = 0.95;
            } else if ($q2 == 4) {
                $q2_risk = 0.25;
                $q2_quality = 0.75;
            }
        } else {
            $q2_risk = 1;
            $q2_quality = 1;
        }
        return $q2_risk;
    }
    function qHabits3($q3)
    {
        if ($q3 != -1) {
            if ($q3 == 0) {
                $q3_risk = 0.55;
                $q3_quality = 0.45;
            } else if ($q3 == 1) {
                $q3_risk = 0.35;
                $q3_quality = 0.65;
            } else if ($q3 == 2) {
                $q3_risk = 0.2;
                $q3_quality = 0.8;
            } else if ($q3 == 3) {
                $q3_risk = 0.02;
                $q3_quality = 0.98;
            } else if ($q3 == 4) {
                $q3_risk = 0.15;
                $q3_quality = 0.85;
            }
        } else {
            $q3_risk = 1;
            $q3_quality = 1;
        }
        return $q3_risk;
    }
    function qHabits4($question4)
    {
        if ($question4 != -1) {
            if ($question4 == 0) {
                $q4_risk = 0.48;
                $q4_quality = 0.52;
            } else if ($question4 == 1) {
                $q4_risk = 0.33;
                $q4_quality = 0.67;
            } else if ($question4 == 2) {
                $q4_risk = 0.15;
                $q4_quality = 0.85;
            } else if ($question4 == 3) {
                $q4_risk = 0.05;
                $q4_quality = 0.95;
            }
        } else {
            $q4_risk = 1;
            $q4_quality = 1;
        }
        return $q4_risk;
    }
    function qHabits5($question5)
    {
        if ($question5 != -1) {
            if ($question5 == 0) {
                $q5_risk = 0.45;
                $q5_quality = 0.55;
            } else if ($question5 == 1) {
                $q5_risk = 0.15;
                $q5_quality = 0.85;
            } else if ($question5 == 2) {
                $q5_risk = 0.05;
                $q5_quality = 0.95;
            } else if ($question5 == 3) {
                $q5_risk = 0.01;
                $q5_quality = 0.99;
            }
        } else {
            $q5_risk = 1;
            $q5_quality = 1;
        }
        return $q5_risk;
    }
    function qResult1($q1, $q2, $q3, $q4, $q5)
    {
        $f1 = $this->qHabits1($q1);
        $f2 = $this->qHabits2($q2);
        $f3 = $this->qHabits3($q3);
        $f4 = $this->qHabits4($q4);
        $f5 = $this->qHabits5($q5);

        return (int) (((10 * $f1 + 8 * $f2 + 9 * $f3 + 8 * $f4 + 6 * $f5) / 41) * 100);
    }

    function Job_q1($q1)
    {
        $risk_job = 1;
        $quality_job = 1;
        if ($q1 != -2) {
            $q1_lists = [[1, 0.016], [2, 0.025], [3, 0.03], [4, 0.04], [5, 0.05], [6, 0.1], [7, 0.1], [8, 0.1], [9, 0.15], [
                10, 0.18
            ], [11, 0.2], [12, 0.22], [13, 0.25], [14, 0.27], [15, 0.3], [16, 0.32], [17, 0.32], [18, 0.35], [19, 0.4]];
            foreach ($q1_lists as $x) {
                if ($x[0] == $q1) {
                    $risk_q1 = $x[1];
                    $quality_q1 = (1 - $x[1]) * 0.9;
                }
            }
        } else {
        }
        $q1_risk = 1;
        $q1_quality = 1;

        $quality_job = $quality_job * $quality_q1;

        return $risk_q1;
    }

    function Job_q2($q2)
    {
        # from 0 to 20 scale
        if ($q2 != -2) {
            if ($q2 >= 0 and $q2 <= 2) {
                $risk_q2 = 0.03;
                $quality_q2 = 0.97;
            } else if ($q2 >= 3 and $q2 <= 7) {
                $risk_q2 = 0.1;
                $quality_q2 = 0.9;
            } else if ($q2 >= 8 and $q2 <= 12) {
                $risk_q2 = 0.28;
                $quality_q2 = 0.72;
            } else if ($q2 >= 13 and $q2 <= 17) {
                $risk_q2 = 0.35;
                $quality_q2 = 0.65;
            } else {
                $risk_q2 = 0.55;
                $quality_q2 = 0.45;
            }
        } else {
            $risk_q2 = 1;
            $quality_q2 = 1;
        }
        return $risk_q2;
    }

    function Job_q3($q3)
    {
        if ($q3 != -2) {
            if ($q3 == 0) {
                $risk_q3 = 0.05;
                $quality_q3 = 0.95;
            } else if ($q3 > 0 and $q3 <= 10) {
                $risk_q3 = 0.18;
                $quality_q3 = 0.82;
            } else if ($q3 > 10 and $q3 <= 25) {
                $risk_q3 = 0.28;
                $quality_q3 = 0.72;
            } else {
                $risk_q3 = 0.45;
                $quality_q3 = 0.55;
            }
        } else {
            $risk_q3 = 1;
            $quality_q3 = 1;
        }
        return $risk_q3;
    }

    function Job_q4($q4)
    {
        if ($q4 != -2) {
            if ($q4 >= 0 and $q4 <= 1) {
                $risk_q4 = 0.05;
                $quality_q4 = 0.95;
            } else if ($q4 > 1 and $q4 < 4) {
                $risk_q4 = 0.18;
                $quality_q4 = 0.82;
            } else if ($q4 >= 4 and $q4 <= 5) {
                $risk_q4 = 0.15;
                $quality_q4 = 0.85;
            } else {
                $risk_q4 = 0.45;
                $quality_q4 = 0.55;
            }
        } else {
            $risk_q4 = 1;
            $quality_q4 = 1;
        }
        return $risk_q4;
    }

    function Job_q5($q5)
    {
        if ($q5 != -2) {
            if ($q5 >= 0 and $q5 < 6) {
                $risk_q5 = 0.02;
                $quality_q5 = 0.98;
            } else if ($q5 >= 6 and $q5 < 11) {
                $risk_q5 = 0.01;
                $quality_q5 = 0.99;
            } else if ($q5 >= 11 and $q5 < 21) {
                $risk_q5 = 0.05;
                $quality_q5 = 0.95;
            } else if ($q5 >= 21 and $q5 < 36) {
                $risk_q5 = 0.1;
                $quality_q5 = 0.9;
            } else if ($q5 >= 36 and $q5 < 50) {
                $risk_q5 = 0.28;
                $quality_q5 = 0.72;
            } else {
                $risk_q5 = 0.45;
                $quality_q5 = 0.55;
            }
        } else {
            $risk_q5 = 1;
            $quality_q5 = 1;
        }

        return $risk_q5;
    }

    function Job_q6($q6)
    {
        $risk_q6 = 0;
        if ($q6 != -2) {
            if ($q6 == 0) {
                $risk_q6 = 0.01;
                $quality_q6 = 0.99;
            } else if ($q6 == 1) {
                $risk_q6 = 0.35;
                $quality_q6 = 0.65;
            } else if ($q6 == 2) {
                $risk_q6 = 0.18;
                $quality_q6 = 0.82;
            }
        } else {
            $risk_q6 = 1;
            $quality_q6 = 1;
        }

        return $risk_q6;
    }
    function Job_q7($first_q7, $second_q7, $third_q7, $fourth_q7, $fifth_q7)
    {
        $risk_fsq7 = 0;
        $risk_scq7 = 0;
        $risk_trq7 = 0;
        $risk_frq7 = 0;
        $risk_ffq7 = 0;
        if ($first_q7 != -2 && $second_q7 != -2 && $third_q7 != -2 && $fourth_q7 != -2 && $fifth_q7 != -2) {
            $first_q7 = [[0, 0.01, 0.99], [1, 0.05, 0.95], [2, 0.1, 0.9], [
                3, 0, 18, 0.82
            ], [4, 0.35, 0.65], [5, 0.55, 0.45]];
            $second_q7 = [[0, 0.01, 0.99], [1, 0.08, 0.92], [2, 0.15, 0.85], [
                3, 0, 23, 0.77
            ], [4, 0.38, 0.62], [5, 0.45, 0.55]];
            $third_q7 = [[0, 0.01, 0.99], [1, 0.05, 0.95], [2, 0.1, 0.9], [
                3, 0, 18, 0.82
            ], [4, 0.3, 0.7], [5, 0.45, 0.55]];
            $fourth_q7 = [[0, 0.01, 0.99], [1, 0.05, 0.95], [2, 0.1, 0.9], [
                3, 0, 15, 0.85
            ], [4, 0.27, 0.73], [5, 0.45, 0.55]];
            $fifth_q7 = [[0, 0.01, 0.99], [1, 0.05, 0.95], [2, 0.08, 0.92], [
                3, 0, 14, 0.86
            ], [4, 0.25, 0.75], [5, 0.43, 0.57]];

            foreach ($first_q7 as $x) {
                if ($first_q7 == $x[0]) {
                    $risk_fsq7 = $x[1];
                    $quality_fsq7 = $x[2];
                }
            }
            foreach ($second_q7 as $x) {
                if ($second_q7 == $x[0]) {
                    $risk_scq7 = $x[1];
                    $quality_scq7 = $x[2];
                }
            }
            foreach ($third_q7 as $x) {
                if ($third_q7 == $x[0]) {
                    $risk_trq7 = $x[1];
                    $quality_trq7 = $x[2];
                }
            }
            foreach ($fourth_q7 as $x) {
                if ($fourth_q7 == $x[0]) {
                    $risk_frq7 = $x[1];
                    $quality_frq7 = $x[2];
                }
            }
            foreach ($fifth_q7 as $x) {
                if ($fifth_q7 == $x[0]) {
                    $risk_ffq7 = $x[1];
                    $quality_ffq7 = $x[2];
                }
            }

            $risk_q7 = ($risk_fsq7 * 5.0 + $risk_scq7 * 5.0 + $risk_trq7 *
                3.0 + $risk_frq7 * 2.0 + $risk_ffq7 * 4.0) / 19.0;
        } else {
            $risk_q7 = 1;
            $quality_q7 = 1;
        }

        return $risk_q7;
    }

    function Job_additional_risk($age)
    {
        if ($age < 20)
            $add_risk = 1;
        else if ($age >= 20 and $age < 30)
            $add_risk = 1.05;
        else if ($age >= 30 and $age < 40)
            $add_risk = 1.17;
        else if ($age >= 40 and $age < 45)
            $add_risk = 1.23;
        else if ($age >= 45 and $age < 50)
            $add_risk = 1.3;
        else if ($age >= 50 and $age < 55)
            $add_risk = 1.4;
        else if ($age >= 55 and $age < 65)
            $add_risk = 1.45;
        else if ($age >= 65)
            $add_risk = 1.5;

        return $add_risk;
    }

    function qRisk($q1, $q2, $q3, $q4, $q5, $q6, $first_q7, $second_q7, $third_q7, $fourth_q7, $fifth_q7)
    {
        $f1 = $this->Job_q1($q1);
        $f2 = $this->Job_q2($q2);
        $f3 = $this->Job_q3($q3);
        $f4 = $this->Job_q4($q4);
        $f5 = $this->Job_q5($q5);
        $f6 = $this->Job_q6($q6);
        $f7 = $this->Job_q7($first_q7, $second_q7, $third_q7, $fourth_q7, $fifth_q7);

        return (int) (((8 * $f1 + 10 * $f2 + 7 * $f3 + 6 * $f4 + 7 * $f5 + 8 * $f6 + 8.5 * $f7) / 56.5) * 100);
    }

    function heritageFunction($gender, $mot, $fat, $gmot, $gfat, $unc, $aunt, $bro, $sis)
    {
        $parents = [
            [0, 0, 0.01, 0.99], [0, 1, 0.3, 0.7],
            [1, 0, 0.25, 0.75], [1, 1, 0.4, 0.6]
        ];
        $gr_parents = [[0, 0, 0.01, 0.99], [0, 1, 0.18, 0.82], [0, 2, 0.3, 0.7], [1, 0, 0.15, 0.85], [
            2, 0, 0.25, 0.75
        ], [1, 1, 0.25, 0.75], [1, 2, 0.35, 0.65], [2, 1, 0.3, 0.7], [2, 2, 0.45, 0.55]];
        $uncles = [
            [0, 0.05, 0.95], [1, 0.18, 0.82],
            [2, 0.27, 0.73], [3, 0.36, 0.64]
        ];
        $aunts = [
            [0, 0.01, 0.99], [1, 0.12, 0.88],
            [2, 0.17, 0.83], [3, 0.26, 0.74]
        ];
        $brothers = [
            [0, 0.05, 0.95], [1, 0.19, 0.81],
            [2, 0.29, 0.71], [3, 0.38, 0.62]
        ];
        $sisters = [
            [0, 0.01, 0.99], [1, 0.11, 0.89],
            [2, 0.19, 0.81], [3, 0.28, 0.72]
        ];
        $ctrl = 0;
        $risk = 0;
        $quality = 0;
        if ($mot != -2 && $fat != -2) {
            $ctrl += 5;
            foreach ($parents as $x) {
                if ($mot == $x[0] && $fat == $x[1]) {
                    if ($gender == 1) {
                        $risk += $x[2] * 5;
                        $quality += $x[3] * 5;
                    } else {
                        $risk += $x[2] * 4.5;
                        $quality += $x[3] * 4.5;
                    }
                }
            }
        }
        if ($gmot != -2 && $gfat != -2) {
            $ctrl += 5;
            foreach ($gr_parents as $y) {
                if ($gmot == $y[0] && $gfat == $y[1]) {
                    if ($gender == 1) {
                        $risk += $y[2] * 4;
                        $quality += $y[3] * 4;
                    } else {
                        $risk += $y[2] * 3.6;
                        $quality += $y[3] * 3.6;
                    }
                }
            }
        }
        if ($unc != -2) {
            $ctrl += 5;
            foreach ($uncles as $z) {
                if ($unc == $z[0]) {
                    if ($gender == 1) {
                        $risk += $z[1] * 2;
                        $quality += $z[2] * 2;
                    } else {
                        $risk += $z[1] * 1.8;
                        $quality += $z[2] * 1.8;
                    }
                }
            }
        }
        if ($aunt != -2) {
            $ctrl += 5;
            foreach ($aunts as $t) {
                if ($aunt == $t[0]) {
                    if ($gender == 1) {
                        $risk += $t[1];
                        $quality += $t[2];
                    } else {
                        $risk += $t[1] * 0.9;
                        $quality += $t[2] * 0.9;
                    }
                }
            }
        }
        if ($bro != -2) {
            $ctrl += 5;
            foreach ($brothers as $w) {
                if ($bro == $w[0]) {
                    if ($gender == 1) {
                        $risk += $w[1] * 3;
                        $quality += $w[2] * 3;
                    } else {
                        $risk += $w[1] * 2.7;
                        $quality += $w[2] * 2.7;
                    }
                }
            }
        }
        if ($sis != -2) {
            $ctrl += 5;
            foreach ($sisters as $v) {
                if ($sis == $v[0]) {
                    if ($gender == 1) {
                        $risk += $v[1] * 2;
                        $quality += $v[2] * 2;
                    } else {
                        $risk += $v[1] * 1.8;
                        $quality += $v[2] * 1.8;
                    }
                }
            }
        }
        if ($ctrl != 0) {
            $risk = $risk / $ctrl;
            $quality = $quality / $ctrl;
        } else {
            $risk = 0;
            $quality = 0;
        }
        return (int) ($risk * 100);
    }

    function totalHeritage(
        $gender,
        $mq1,
        $fq1,
        $gmq1,
        $gfq1,
        $unq1,
        $auq1,
        $brq1,
        $siq1,
        $mq2,
        $fq2,
        $gmq2,
        $gfq2,
        $unq2,
        $auq2,
        $brq2,
        $siq2,
        $mq3,
        $fq3,
        $gmq3,
        $gfq3,
        $unq3,
        $auq3,
        $brq3,
        $siq3,
        $mq4,
        $fq4,
        $gmq4,
        $gfq4,
        $unq4,
        $auq4,
        $brq4,
        $siq4,
        $mq5,
        $fq5,
        $gmq5,
        $gfq5,
        $unq5,
        $auq5,
        $brq5,
        $siq5,
        $mq6,
        $fq6,
        $gmq6,
        $gfq6,
        $unq6,
        $auq6,
        $brq6,
        $siq6,
        $mq7,
        $fq7,
        $gmq7,
        $gfq7,
        $unq7,
        $auq7,
        $brq7,
        $siq7,
        $mq8,
        $fq8,
        $gmq8,
        $gfq8,
        $unq8,
        $auq8,
        $brq8,
        $siq8,
        $mq9,
        $fq9,
        $gmq9,
        $gfq9,
        $unq9,
        $auq9,
        $brq9,
        $siq9,
        $mq10,
        $fq10,
        $gmq10,
        $gfq10,
        $unq10,
        $auq10,
        $brq10,
        $siq10,
        $mq11,
        $fq11,
        $gmq11,
        $gfq11,
        $unq11,
        $auq11,
        $brq11,
        $siq11
    ) {
        $risk_q1 = $this->heritageFunction(
            $gender,
            $mq1,
            $fq1,
            $gmq1,
            $gfq1,
            $unq1,
            $auq1,
            $brq1,
            $siq1
        ) * 1.25;


        $risk_q2 = $this->heritageFunction(
            $gender,
            $mq2,
            $fq2,
            $gmq2,
            $gfq2,
            $unq2,
            $auq2,
            $brq2,
            $siq2
        ) * 1.2;


        $risk_q3 = $this->heritageFunction(
            $gender,
            $mq3,
            $fq3,
            $gmq3,
            $gfq3,
            $unq3,
            $auq3,
            $brq3,
            $siq3
        ) * 1.2;

        $risk_q4 = $this->heritageFunction(
            $gender,
            $mq4,
            $fq4,
            $gmq4,
            $gfq4,
            $unq4,
            $auq4,
            $brq4,
            $siq4
        ) * 1.15;

        $risk_q5 = $this->heritageFunction(
            $gender,
            $mq5,
            $fq5,
            $gmq5,
            $gfq5,
            $unq5,
            $auq5,
            $brq5,
            $siq5
        ) * 1.1;


        $risk_q6 = $this->heritageFunction(
            $gender,
            $mq6,
            $fq6,
            $gmq6,
            $gfq6,
            $unq6,
            $auq6,
            $brq6,
            $siq6
        ) * 1.15;


        $risk_q7 = $this->heritageFunction(
            $gender,
            $mq7,
            $fq7,
            $gmq7,
            $gfq7,
            $unq7,
            $auq7,
            $brq7,
            $siq7
        ) * 1.18;


        $risk_q8 = $this->heritageFunction(
            $gender,
            $mq8,
            $fq8,
            $gmq8,
            $gfq8,
            $unq8,
            $auq8,
            $brq8,
            $siq8
        ) * 1.18;


        $risk_q9 = $this->heritageFunction(
            $gender,
            $mq9,
            $fq9,
            $gmq9,
            $gfq9,
            $unq9,
            $auq9,
            $brq9,
            $siq9
        ) * 1.1;


        $risk_q10 = $this->heritageFunction(
            $gender,
            $mq10,
            $fq10,
            $gmq10,
            $gfq10,
            $unq10,
            $auq10,
            $brq10,
            $siq10
        ) * 1.15;


        $risk_q11 = $this->heritageFunction(
            $gender,
            $mq11,
            $fq11,
            $gmq11,
            $gfq11,
            $unq11,
            $auq11,
            $brq11,
            $siq11
        ) * 1.15;

        $risk = (3 * $risk_q1 + 3 * $risk_q2 + 2.5 * $risk_q3 + 2 * $risk_q4 + 2 * $risk_q5 + 1.5 * $risk_q6 + 2.5 * $risk_q7 + 2 * $risk_q8 + $risk_q9 + 1.5 * $risk_q10 + $risk_q11) / 22;
        return $risk;
    }

    function Food_q1($q1)
    {
        $quality_food = 1;
        if ($q1 != -2) {
            if ($q1 >= 0 and $q1 < 1.0)
                $risk_q1 = 0.55;
            else if ($q1 >= 1.0 and $q1 < 1.5)
                $risk_q1 = 0.25;
            else if ($q1 >= 1.5 and $q1 < 2.0)
                $risk_q1 = 0.1;
            else if ($q1 >= 2.0 and $q1 < 2.5)
                $risk_q1 = 0.05;
            else if ($q1 >= 2.5 and $q1 < 3.5)
                $risk_q1 = 0.01;
            else if ($q1 >= 3.5 and $q1 < 8.0)
                $risk_q1 = 0.2;
            else
                $risk_q1 = 1;
        } else
            $risk_q1 = 1;
        return $risk_q1;
    }

    function Food_q2($q2)
    {
        if ($q2 != -2) {
            if ($q2 == 0)
                $risk_q2 = 0.04;
            else if ($q2 >= 1 and $q2 <= 2)
                $risk_q2 = 0.01;
            else if ($q2 >= 3 and $q2 <= 4)
                $risk_q2 = 0.2;
            else if ($q2 >= 5 and $q2 <= 6)
                $risk_q2 = 0.35;
            else if ($q2 == 7)
                $risk_q2 = 0.48;
            else
                $risk_q2 = 1;
        } else
            $risk_q2 = 1;

        return $risk_q2;
    }
    function Food_q3($q3)
    {
        if ($q3 != -2) {
            if ($q3 == 1)
                $risk_q3 = 0.45;
            else if ($q3 == 0)
                $risk_q3 = 0.05;
        } else
            $risk_q3 = 1;
        return $risk_q3;
    }
    function Food_q4($q4)
    {
        if ($q4 != -2) {
            if ($q4 == 0)
                $risk_q4 = 0.01;
            else if ($q4 >= 1 and $q4 <= 2)
                $risk_q4 = 0.1;
            else if ($q4 >= 3 and $q4 <= 4)
                $risk_q4 = 0.15;
            else if ($q4 >= 5 and $q4 <= 6)
                $risk_q4 = 0.23;
            else if ($q4 == 7)
                $risk_q4 = 0.55;
            else
                $risk_q4 = 1;
        } else
            $risk_q4 = 1;
        return $risk_q4;
    }
    function Food_q5($q5)
    {
        if ($q5 != -2) {
            if ($q5 == 0)
                $risk_q5 = 0.01;
            else if ($q5 > 0 and $q5 <= 0.5)
                $risk_q5 = 0.05;
            else if ($q5 > 0.5 and $q5 <= 1.5)
                $risk_q5 = 0.1;
            else if ($q5 > 1.5 and $q5 <= 2.5)
                $risk_q5 = 0.28;
            else if ($q5 > 2.5 and $q5 <= 4.5)
                $risk_q5 = 0.42;
            else if ($q5 > 4.5)
                $risk_q5 = 0.52;
            else
                $risk_q5 = 1;
        } else
            $risk_q5 = 1;

        return $risk_q5;
    }
    function Food_q6($q6)
    {
        if ($q6 != -2) {
            if ($q6 == 0)
                $risk_q6 = 0.01;
            else if ($q6 >= 1 and $q6 <= 2)
                $risk_q6 = 0.05;
            else if ($q6 >= 3 and $q6 <= 4)
                $risk_q6 = 0.25;
            else if ($q6 >= 5 and $q6 <= 6)
                $risk_q6 = 0.34;
            else if ($q6 == 7)
                $risk_q6 = 0.48;
            else
                $risk_q6 = 1;
        } else
            $risk_q6 = 1;
        return $risk_q6;
    }
    function Food_q7($q7)
    {
        if ($q7 != -2) {
            if ($q7 == 0)
                $risk_q7 = 0.15;
            else if ($q7 >= 1 and $q7 <= 2)
                $risk_q7 = 0.01;
            else if ($q7 >= 3 and $q7 <= 4)
                $risk_q7 = 0.23;
            else if ($q7 >= 5 and $q7 <= 6)
                $risk_q7 = 0.3;
            else if ($q7 == 7)
                $risk_q7 = 0.45;
            else
                $risk_q7 = 1;
        } else
            $risk_q7 = 1;
        return $risk_q7;
    }
    function Food_q8($q8)
    {
        if ($q8 != -2) {
            if ($q8 == 0)
                $risk_q8 = 0.45;
            else if ($q8 == 1)
                $risk_q8 = 0.2;
            else if ($q8 == 2)
                $risk_q8 = 0.1;
            else if ($q8 >= 3 and $q8 <= 4)
                $risk_q8 = 0.05;
            else if ($q8 >= 5 and $q8 <= 6)
                $risk_q8 = 0.02;
            else if ($q8 == 7)
                $risk_q8 = 0.01;
            else
                $risk_q8 = 1;
        } else
            $risk_q8 = 1;
        return $risk_q8;
    }
    function Food_q9($q9)
    {
        if ($q9 != -2) {
            if ($q9 == 0)
                $risk_q9 = 0.45;
            else if ($q9 == 1)
                $risk_q9 = 0.05;
            else if ($q9 == 2)
                $risk_q9 = 0.15;
        } else
            $risk_q9 = 1;
        return $risk_q9;
    }
    function Food_q10($q10)
    {
        if ($q10 != -2) {
            if ($q10 == 0)
                $risk_q10 = 0.45;
            else if ($q10 >= 1 and $q10 <= 2)
                $risk_q10 = 0.3;
            else if ($q10 >= 3 and $q10 <= 4)
                $risk_q10 = 0.1;
            else if ($q10 >= 5 and $q10 <= 6)
                $risk_q10 = 0.05;
            else if ($q10 == 7)
                $risk_q10 = 0.03;
            else
                $risk_q10 = 1;
        } else
            $risk_q10 = 1;
        return $risk_q10;
    }
    function Food_q11($q11)
    {
        if ($q11 != -2) {
            if ($q11 == 0)
                $risk_q11 = 0.5;
            else if ($q11 >= 1 and $q11 <= 2)
                $risk_q11 = 0.35;
            else if ($q11 >= 3 and $q11 <= 4)
                $risk_q11 = 0.1;
            else if ($q11 >= 5 and $q11 <= 6)
                $risk_q11 = 0.05;
            else if ($q11 == 7)
                $risk_q11  = 0.01;
            else
                $risk_q11 = 1;
        } else {
        }
        $risk_q11 = 1;
        return $risk_q11;
    }
    function Food_q12($q12)
    {
        if ($q12 != -2) {
            if ($q12 == 0)
                $risk_q12 = 0.45;
            else if ($q12 >= 1 and $q12 <= 2)
                $risk_q12 = 0.32;
            else if ($q12 >= 3 and $q12 <= 4)
                $risk_q12 = 0.15;
            else if ($q12 >= 5 and $q12 <= 6)
                $risk_q12 = 0.05;
            else if ($q12 == 7)
                $risk_q12 = 0.01;
            else
                $risk_q12 = 1;
        } else
            $risk_q12 = 1;
        return $risk_q12;
    }
    function Food_q13($q13)
    {
        if ($q13 != -2) {
            if ($q13 == 0)
                $risk_q13 = 0.02;
            else if ($q13 >= 1 and $q13 <= 2)
                $risk_q13 = 0.07;
            else if ($q13 >= 3 and $q13 <= 4)
                $risk_q13 = 0.25;
            else if ($q13 >= 5 and $q13 <= 6)
                $risk_q13 = 0.35;
            else if ($q13 == 7)
                $risk_q13 = 0.6;
            else
                $risk_q13 = 1;
        } else
            $risk_q13 = 1;
        return $risk_q13;
    }
    function Food_q14($first_q14, $second_q14, $third_q14)
    {
        if ($first_q14 != -2 and $second_q14 != -2 and $third_q14 != -2) {
            $tab_q14 = [[0, 0, 0, 0.05, 0.95], [0, 0, 1, 0.1, 0.9], [0, 1, 0, 0.08, 0.92], [0, 1, 1, 0.15, 0.85], [
                1, 0, 0, 0.07, 0.93
            ], [1, 0, 1, 0.18, 0.82], [1, 1, 0, 0.21, 0.79], [1, 1, 1, 0.25, 0.75]];
            foreach ($tab_q14 as $x) {
                if ($first_q14 == $x[0] and $second_q14 == $x[1] and $third_q14 == $x[2])
                    $risk_q14 = $x[3];
            }
        } else
            $risk_q14 = 1;
        return $risk_q14;
    }
    function riskFood($q1, $q2, $q3, $q4, $q5, $q6, $q7, $q8, $q9, $q10, $q11, $q12, $q13, $first_q14, $second_q14, $third_q14)
    {
        $r1 = $this->Food_q1($q1);
        $r2 = $this->Food_q2($q2);
        $r3 = $this->Food_q3($q3);
        $r4 = $this->Food_q4($q4);
        $r5 = $this->Food_q5($q5);
        $r6 = $this->Food_q6($q6);
        $r7 = $this->Food_q7($q7);
        $r8 = $this->Food_q8($q8);
        $r9 = $this->Food_q9($q9);
        $r10 = $this->Food_q10($q10);
        $r11 = $this->Food_q11($q11);
        $r12 = $this->Food_q12($q12);
        $r13 = $this->Food_q13($q13);
        $r14 = $this->Food_q14($first_q14, $second_q14, $third_q14);

        $risk = (10 * $r1 + 6 * $r2 + 8 * $r3 + 7 * $r4 + 8 * $r5 + 8 * $r6 + 6 * $r7 + 9 * $r8 + 7 * $r9 + 8 * $r10 + 9 * $r11 + 8 * $r12 + 9 * $r13 + 8 * $r14) / 111;
        return (int) ($risk * 100);
    }

    function Wbc($wbc, $gender, $age)
    {
        if ($wbc != -2) {
            if ($wbc <= 5.0)
                $risk_Filter1 = 0.05;
            else if ($wbc > 5.0 and $wbc <= 10) {
                if ($gender == 1 and $wbc > 6.6) {
                    if ($age >= 50)
                        $risk_Filter1 = 0.45;
                    else
                        $risk_Filter1 = 0.2;
                } else if ($gender == 1 and $wbc < 6.6)
                    $risk_Filter1 = 0.15;
                else if ($gender == "Ženski" and $wbc > 7)
                    $risk_Filter1 = 0.3;
                else
                    $risk_Filter1 = 0.2;
            } else if ($wbc > 10 and $wbc <= 15) {
                if ($gender == 1) {
                    if ($age >= 50)
                        $risk_Filter1 = 0.8;
                    else
                        $risk_Filter1 = 0.7;
                } else {
                    if ($age > 55)
                        $risk_Filter1 = 0.75;
                    else
                        $risk_Filter1 = 0.65;
                }
            } else {
                if ($gender == 1) {
                    if ($age > 50)
                        $risk_Filter1 = 0.9;
                    else
                        $risk_Filter1 = 0.8;
                } else {
                    if ($age > 55)
                        $risk_Filter1 = 0.85;
                    else
                        $risk_Filter1 = 0.75;
                }
            }
        } else
            $risk_Filter1 = 1;
        return $risk_Filter1;
    }
    function Hgb($hgb, $gender, $age)
    {
        if ($hgb != -2) {
            if ($gender == 1) {
                if ($hgb < 100)
                    $risk_hgb = 0.75;
                else if ($hgb >= 100 and $hgb < 110)
                    $risk_hgb = 0.3;
                else if ($hgb >= 110 and $hgb < 120)
                    $risk_hgb = 0.2;
                else if ($hgb >= 120 and $hgb < 145)
                    $risk_hgb = 0.05;
                else if ($hgb >= 145 and $hgb < 160)
                    $risk_hgb = 0.1;
                else if ($hgb >= 160 and $hgb < 170)
                    $risk_hgb = 0.25;
                else
                    $risk_hgb = 0.8;
            } else {
                if ($hgb < 110)
                    $risk_hgb = 0.75;
                else if ($hgb >= 110 and $hgb < 120)
                    $risk_hgb = 0.3;
                else if ($hgb >= 120 and $hgb < 130)
                    $risk_hgb = 0.2;
                else if ($hgb >= 130 and $hgb < 155)
                    $risk_hgb = 0.05;
                else if ($hgb >= 155 and $hgb < 170)
                    $risk_hgb = 0.1;
                else if ($hgb >= 170 and $hgb < 180)
                    $risk_hgb = 0.25;
                else
                    $risk_hgb = 0.8;
            }
        } else
            $risk_hgb = 1;

        return $risk_hgb;
    }
    function Hgb_move_by_year($hgb_move)
    {
        if ($hgb_move != -2) {
            if ($hgb_move <= 0)
                $risk_by_hgb_move = 0.01;
            else if ($hgb_move > 0 and $hgb_move <= 0.01)
                $risk_by_hgb_move = 0.05;
            else if ($hgb_move > 0.01 and $hgb_move <= 0.1)
                $risk_by_hgb_move = 0.1;
            else if ($hgb_move > 0.1 and $hgb_move <= 0.2)
                $risk_by_hgb_move = 0.15;
            else
                $risk_by_hgb_move = 0.25;
        } else
            $risk_by_hgb_move = 1;

        return $risk_by_hgb_move;
    }
    function Neu($neu)
    {
        if ($neu != -2)
            if ($neu < 4.4)
                $risk_neu = 0.05;
            else if ($neu > 5.8)
                $risk_neu = 0.35;
            else
                $risk_neu = 0.2;
        else
            $risk_neu = 0;

        return $risk_neu;
    }
    function Neu_Lym_ratio($neu, $lym, $age)
    {
        if ($neu != -2 and $lym != -2) {
            $nlr = $neu / $lym;
            if ($nlr < 2.0) {
                if ($age < 47)
                    $risk_nlr = 0.05;
                else
                    $risk_nlr = 0.14;
            } else if ($nlr >= 2.0 and $nlr < 2.96) {
                if ($age < 52)
                    $risk_nlr = 0.2;
                else
                    $risk_nlr = 0.25;
            } else if ($nlr >= 2.96 and $nlr < 4.68) {
                if ($age < 61)
                    $risk_nlr = 0.3;
                else
                    $risk_nlr = 0.4;
            } else {
                if ($age < 66.5)
                    $risk_nlr = 0.4;
                else
                    $risk_nlr = 0.45;
            }
        } else
            $risk_nlr = 0;

        return $risk_nlr;
    }
    function BNP($bnp, $age)
    {
        if ($bnp != -2) {
            if ($bnp < 77) {
                if ($age < 47)
                    $risk_bnp = 0.05;
                else
                    $risk_bnp = 0.2;
            } else if ($bnp >= 77 and $bnp < 321) {
                if ($age < 52)
                    $risk_bnp = 0.15;
                else
                    $risk_bnp = 0.3;
            } else if ($bnp >= 321 and $bnp < 958) {
                if ($age < 61)
                    $risk_bnp = 0.35;
                else
                    $risk_bnp = 0.4;
            } else {
                if ($age < 66.5)
                    $risk_bnp = 0.38;
                else
                    $risk_bnp = 0.45;
            }
        } else
            $risk_bnp = 0;

        return $risk_bnp;
    }

    function rizikF1($wbc, $hgb, $hgb_move, $neu, $lym, $bnp, $gender, $age)
    {
        $risk_formula_filter1 = ($this->Wbc($wbc, $gender, $age) * 3 +  $this->Hgb($hgb, $gender, $age) * 5 + $this->Neu_Lym_ratio($neu, $lym, $age) * 6 + $this->BNP($bnp, $age) * 4 + $this->Hgb_move_by_year($hgb_move) * 2 + $this->Neu($neu)) / 21.0;
        return (int) ($risk_formula_filter1 * 100);
    }

    function Potassium($k)
    {
        if ($k != -2) {
            if ($k < 2.5)
                $risk_k = 0.75;
            else if ($k >= 2.5 and $k < 3.0)
                $risk_k = 0.5;
            else if ($k >= 3.0 and $k < 3.5)
                $risk_k = 0.4;
            else if ($k >= 3.5 and $k < 4.5)
                $risk_k = 0.23;
            else if ($k >= 4.5 and $k < 5.0)
                $risk_k = 0.1;
            else if ($k >= 5.0 and $k < 5.6)
                $risk_k = 0.02;
            else
                $risk_k = 0.6;
        } else
            $risk_k = 1;
        return $risk_k;
    }
    function Calcium($ca, $age)
    {
        if ($ca != -2) {
            if ($ca < 2.0)
                $risk_ca = 0.6;
            else if ($ca > 2.0 and $ca < 2.2)
                $risk_ca = 0.35;
            else if ($ca > 2.2 and $ca < 2.5)
                $risk_ca = 0.05;
            else if ($ca > 2.5 and $ca < 2.7) {
                if ($age < 35)
                    $risk_ca = 0.25;
                else
                    $risk_ca = 0.45;
            } else
                $risk_ca = 0.5;
        } else
            $risk_ca = 1;

        return $risk_ca;
    }

    function Sodium($na)
    {
        if ($na != -2) {
            if ($na <= 130)
                $risk_na = 0.85;
            else if ($na > 130 and $na <= 135)
                $risk_na = 0.4;
            else if ($na > 135 and $na <= 139)
                $risk_na = 0.25;
            else if ($na > 139 and $na <= 145)
                $risk_na = 0.02;
            else if ($na > 145 and $na <= 152)
                $risk_na = 0.45;
            else
                $risk_na = 0.7;
        } else
            $risk_na = 1;

        return $risk_na;
    }

    function Magnesium($mg)
    {
        if ($mg != -2) {
            if ($mg < 1.7)
                $risk_mg = 0.82;
            else if ($mg >= 1.7 and $mg <= 2.2)
                $risk_mg = 0.5;
            else if ($mg > 2.2 and $mg < 4.2)
                $risk_mg = 0.25;
            else if ($mg >= 4.2 and $mg <= 6.8)
                $risk_mg = 0.05;
            else
                $risk_mg = 0.3;
        } else
            $risk_mg = 1;

        return $risk_mg;
    }

    function rizikF2($k, $na, $ca, $mg, $age)
    {
        $risk_formula_filter2 = ($this->Potassium($k) * 4 + $this->Sodium($na) * 3 + $this->Magnesium($mg) * 2.5 + $this->Calcium($ca, $age) * 3.5) / 13.0;
        return (int) ($risk_formula_filter2 * 100);
    }

    function Tryg($tryg)
    {
        if ($tryg != -2) {
            if ($tryg <= 1.7)
                $risk_tryg = 0.03;
            else if ($tryg > 1.7 and $tryg <= 2.2)
                $risk_tryg = 0.1;
            else if ($tryg > 2.2 and $tryg <= 5.6)
                $risk_tryg = 0.3;
            else if ($tryg > 5.6 and $tryg <= 11.2)
                $risk_tryg = 0.45;
            else
                $risk_tryg = 0.55;
        } else
            $risk_tryg = 1;

        return $risk_tryg;
    }
    function Hdl($hdl, $gender)
    {
        if ($hdl != -2) {
            if ($gender == "Muški") {
                if ($hdl < 1.3)
                    $risk_hdl = 0.8;
                else if ($hdl >= 1.3 and $hdl < 1.6)
                    $risk_hdl = 0.45;
                else
                    $risk_hdl = 0.1;
            } else {
                if ($hdl < 1.0)
                    $risk_hdl = 0.8;
                else if ($hdl >= 1.0 and $hdl < 1.6)
                    $risk_hdl = 0.45;
                else
                    $risk_hdl = 0.1;
            }
        } else
            $risk_hdl = 1;
        return $risk_hdl;
    }

    function Ldl($ldl)
    {
        if ($ldl != -2) {
            if ($ldl < 1.8)
                $risk_ldl = 0.05;
            else if ($ldl >= 1.8 and $ldl < 2.59)
                $risk_ldl = 0.15;
            else if ($ldl >= 2.59 and $ldl < 3.34)
                $risk_ldl = 0.25;
            else if ($ldl >= 3.34 and $ldl < 4.12)
                $risk_ldl = 0.35;
            else if ($ldl >= 4.12 and $ldl < 4.9)
                $risk_ldl = 0.45;
            else
                $risk_ldl = 0.55;
        } else
            $risk_ldl = 1;

        return $risk_ldl;
    }

    function Total_Cholesterol($hdl, $ldl, $tryg)
    {
        if ($hdl != -2 and $ldl != -2 and $tryg != -2)
            $total_ch = $hdl + $ldl + $tryg * 0.2;
        return $total_ch;
    }

    function Hdl_Total_Cholesterol_Rate($hdl, $ldl, $tryg)
    {
        if ($hdl != -2 and $ldl != -2 and $tryg != -2) {
            $rate1 = $hdl / $this->Total_Cholesterol($hdl, $ldl, $tryg);
            if ($rate1 >= 0.24)
                $risk_ratio1 = 0.05;
            else if ($rate1 < 0.24 and $rate1 >= 0.1)
                $risk_ratio1 = 0.35;
            else
                $risk_ratio1 = 0.75;
        } else
            $risk_ratio1 = 1;

        return $risk_ratio1;
    }

    function Tryg_Hdl_Rate($hdl, $ldl, $tryg)
    {
        if ($hdl != -2 and $ldl != -2 and $tryg != -2) {
            $rate2 = $tryg / $hdl;
            if ($rate2 < 2)
                $risk_ratio2 = 0.05;
            else if ($rate2 >= 2 and $rate2 < 4)
                $risk_ratio2 = 0.35;
            else if ($rate2 >= 4 and $rate2 < 6)
                $risk_ratio2 = 0.55;
            else
                $risk_ratio2 = 0.8;
        } else
            $risk_ratio2 = 1;

        return $risk_ratio2;
    }

    function rizikF3($tryg, $hdl, $ldl, $gender)
    {
        $rizik = ($this->Tryg($tryg) * 3 + $this->Hdl($hdl, $gender) * 2 + $this->Ldl($ldl) * 2 + $this->Hdl_Total_Cholesterol_Rate($hdl, $ldl, $tryg) * 5 + $this->Tryg_Hdl_Rate($hdl, $ldl, $tryg) * 4) / 16;
        return (int) ($rizik * 100);
    }

    function Creatinin($creatinin, $gender, $age)
    {
        if ($creatinin != -2) {
            # Creatinin je u micro molls/liter and it needs to convert in mg/dl
            $crt = $creatinin * 0.01131222;
            if ($gender == "Muški") {
                if ($crt < 0.6)
                    $risk_crt = 0.2;
                else if ($crt >= 0.6 and $crt < 1.3)
                    $risk_crt = 0.01;
                else if ($crt >= 1.3 and $crt < 1.6)
                    $risk_crt = 0.1;
                else if ($crt >= 1.6 and $crt < 4.6)
                    $risk_crt = 0.25;
                else if ($crt >= 4.6 and $crt < 9.9)
                    $risk_crt = 0.4;
                else
                    $risk_crt = 0.85;
            } else {
                if ($crt < 0.5)
                    $risk_crt = 0.2;
                else if ($crt >= 0.5 and $crt < 1.1)
                    $risk_crt = 0.01;
                else if ($crt >= 1.1 and $crt < 1.5)
                    $risk_crt = 0.1;
                else if ($crt >= 1.5 and $crt < 4.6)
                    $risk_crt = 0.25;
                else if ($crt >= 4.6 and $crt < 9.9)
                    $risk_crt = 0.4;
                else
                    $risk_crt = 0.85;
            }
        } else
            $risk_crt = 1;

        if ($creatinin != -2) {
            $age_diff = $age - 50;
            if ($age_diff > 0)
                $ad_power = $age_diff % 10;
            else
                $ad_power = 0;
            $risk_crt = $risk_crt * 0.9 ** $ad_power;
        }

        return $risk_crt;
    }

    function Urea($urea)
    {
        if ($urea != -2) {
            if ($urea >= 3.0 and $urea < 8.2)
                $risk_urea = 0.02;
            else if ($urea < 3.0)
                $risk_urea = 0.1;
            else if ($urea >= 8.2 and $urea < 12)
                $risk_urea = 0.25;
            else if ($urea >= 12 and $urea < 15)
                $risk_urea = 0.3;
            else
                $risk_urea = 0.45;
        } else
            $risk_urea = 1;

        return $risk_urea;
    }

    function BUN($bun, $gender)
    {
        if ($bun != -2) {
            if ($gender == "Muški") {
                if ($bun < 8)
                    $risk_bun = 0.25;
                else if ($bun >= 8 and $bun < 22)
                    $risk_bun = 0.03;
                else if ($bun >= 22 and $bun < 40)
                    $risk_bun = 0.3;
                else if ($bun >= 40 and $bun < 100)
                    $risk_bun = 0.6;
                else
                    $risk_bun = 0.95;
            } else {
                if ($bun < 6)
                    $risk_bun = 0.25;
                else if ($bun >= 6 and $bun < 20)
                    $risk_bun = 0.03;
                else if ($bun >= 20 and $bun < 38)
                    $risk_bun = 0.3;
                else if ($bun >= 38 and $bun < 100)
                    $risk_bun = 0.6;
                else
                    $risk_bun = 0.95;
            }
        } else
            $risk_bun = 1;
        return $risk_bun;
    }

    function Bun_Creatinin_Ratio($bun, $creatinin)
    {
        if ($bun != -2 and $creatinin != -2) {
            $ratio1 = $bun / $creatinin;
            if ($ratio1 < 10)
                $risk_rat1 = 0.85;
            else if ($ratio1 >= 10 and $ratio1 <= 20)
                $risk_rat1 = 0.05;
            else
                $risk_rat1 = 0.35;
        } else
            $risk_rat1 = 1;

        return $risk_rat1;
    }

    function Urea_Creatinin_Ratio($urea, $creatinin)
    {
        if ($urea != -2 and $creatinin != -2) {
            $ratio2 = $urea * 1000 / $creatinin;
            if ($ratio2 < 40)
                $risk_rat2 = 0.88;
            else if ($ratio2 > 100)
                $risk_rat2 = 0.3;
            else
                $risk_rat2 = 0.03;
        } else
            $risk_rat2 = 1;

        return $risk_rat2;
    }

    function rizikF4($creatinin, $urea, $bun, $gender, $age)
    {
        $risk_formula_filter4 = ($this->Bun_Creatinin_Ratio($bun, $creatinin) * 7 + $this->Urea_Creatinin_Ratio($urea, $creatinin) * 6 + $this->Creatinin($creatinin, $gender, $age) * 4 + $this->Urea($urea) * 4 + $this->BUN($bun, $gender) * 5) / 23;
        return (int) ($risk_formula_filter4 * 100);
    }

    function CK($ck, $gender)
    {
        if ($ck != -2) {
            if ($gender == "Muški") {
                if ($ck >= 6 and $ck <= 11)
                    $risk_ck = 0.05;
                else if ($ck >= 12 and $ck <= 17)
                    $risk_ck = 0.2;
                else if ($ck >= 18)
                    $risk_ck = 0.45;
                else
                    $risk_ck = 0.35;
            } else {
                if ($ck >= 6 and $ck <= 7)
                    $risk_ck = 0.05;
                else if ($ck >= 8 and $ck <= 14)
                    $risk_ck = 0.2;
                else if ($ck >= 15 and $ck <= 17)
                    $risk_ck = 0.3;
                else if ($ck >= 18)
                    $risk_ck = 0.45;
                else
                    $risk_ck = 0.35;
            }
        } else
            $risk_ck = 1;
        return $risk_ck;
    }

    function CKMB($ckmb, $gender)
    {
        if ($ckmb != -2) {
            if ($gender == "Muški") {
                if ($ckmb < 4.94)
                    $risk_ckmb = 0.05;
                else if ($ckmb >= 4.94 and $ckmb <= 7.7)
                    $risk_ckmb = 0.1;
                else
                    $risk_ckmb = 0.45;
            } else {
                if ($ckmb < 2.88)
                    $risk_ckmb = 0.05;
                else if ($ckmb >= 2.88 and $ckmb <= 4.3)
                    $risk_ckmb = 0.1;
                else
                    $risk_ckmb = 0.45;
            }
        } else
            $risk_ckmb = 1;
        return $risk_ckmb;
    }

    function Myg($myg)
    {
        if ($myg != -2) {
            if ($myg < 50)
                $risk_myg = 0.01;
            else if ($myg >= 50 and $myg <= 85)
                $risk_myg = 0.05;
            else if ($myg > 85 and $myg <= 230)
                $risk_myg = 0.3;
            else if ($myg > 230 and $myg <= 450)
                $risk_myg = 0.5;
            else
                $risk_myg = 0.9;
        } else
            $risk_myg = 1;

        return $risk_myg;
    }

    function CTI($cti)
    {
        if ($cti != -2) {
            if ($cti < 0.06)
                $risk_cti = 0.01;
            else if ($cti >= 0.06 and $cti <= 0.49)
                $risk_cti = 0.2;
            else
                $risk_cti = 0.4;
        } else
            $risk_cti = 1;
        return $risk_cti;
    }

    function CTT($ctt)
    {
        if ($ctt != -2) {
            if ($ctt < 0.01)
                $risk_ctt = 0.05;
            else
                $risk_ctt = 0.4;
        } else
            $risk_ctt = 1;
        return $risk_ctt;
    }

    function CRP_HDL_Ratio($crp, $hdl)
    {
        if ($crp != -2 and $hdl > 0) {
            $ratio1 = 38.6 * $crp / $hdl;
            if ($ratio1 > 7.87)
                $risk_crp_hdl = 0.05;
            else
                $risk_crp_hdl = 0.5;
        } else
            $risk_crp_hdl = 1;
        return $risk_crp_hdl;
    }

    function CRP($crp)
    {
        if ($crp != -2) {
            if ($crp <= 1)
                $risk_crp = 0.01;
            else if ($crp > 1 and $crp <= 3)
                $risk_crp = 0.25;
            else if ($crp > 10)
                $risk_crp = 0.9;
            else
                $risk_crp = 0.55;
        } else
            $risk_crp = 1;
        return $risk_crp;
    }

    function rizikF5($ck, $ckmb, $myg, $cti, $ctt, $crp, $gender, $age, $hdl)
    {
        $risk_formula_filter5 = ($this->CK($ck, $gender) * 4 + $this->CKMB($ckmb, $gender) * 3 + $this->Myg($myg) * 3 + $this->CTI($cti) * 2 + $this->CTT($ctt) * 2 + $this->CRP_HDL_Ratio($crp, $hdl) * 4 + $this->CRP($crp) * 5) / 25.0;
        return (int) ($risk_formula_filter5 * 100);
    }

    function Glu($glu)
    {
        if ($glu != -2) {
            if ($glu < 3.9)
                $risk_glu = 0.25;
            else if ($glu >= 3.9 and $glu < 6.1)
                $risk_glu = 0.01;
            else if ($glu >= 6.1 and $glu < 7.8)
                $risk_glu = 0.25;
            else if ($glu >= 7.8 and $glu < 9.4)
                $risk_glu = 0.35;
            else if ($glu >= 9.4 and $glu < 11.1)
                $risk_glu = 0.42;
            else
                $risk_glu = 0.5;
        } else
            $risk_glu = 1;

        return $risk_glu;
    }

    function Ast($ast)
    {
        if ($ast != -2) {
            if ($ast < 5)
                $risk_ast = 0.3;
            else if ($ast >= 5 and $ast < 8)
                $risk_ast = 0.15;
            else if ($ast >= 8 and $ast < 38)
                $risk_ast = 0.01;
            else if ($ast >= 38 and $ast < 48)
                $risk_ast = 0.1;
            else
                $risk_ast = 0.45;
        } else
            $risk_ast = 1;
        return $risk_ast;
    }

    function Alt($alt)
    {
        if ($alt != -2) {
            if ($alt < 7)
                $risk_alt = 0.3;
            else if ($alt >= 7 and $alt < 35)
                $risk_alt = 0.15;
            else if ($alt >= 35 and $alt < 50)
                $risk_alt = 0.01;
            else if ($alt >= 50 and $alt < 55)
                $risk_alt = 0.1;
            else
                $risk_alt = 0.48;
        } else
            $risk_alt = 1;

        return $risk_alt;
    }

    function Ggt($ggt, $gender)
    {
        if ($ggt != -2) {
            if ($gender == "Muški") {
                if ($ggt < 9)
                    $risk_ggt = 0.2;
                else if ($ggt >= 9 and $ggt < 15)
                    $risk_ggt = 0.1;
                else if ($ggt >= 15 and $ggt < 48)
                    $risk_ggt = 0.01;
                else if ($ggt >= 48 and $ggt < 70)
                    $risk_ggt = 0.15;
                else
                    $risk_ggt = 0.4;
            } else
                if ($ggt < 5)
                $risk_ggt = 0.2;
            else if ($ggt >= 5 and $ggt < 9)
                $risk_ggt = 0.1;
            else if ($ggt >= 9 and $ggt < 40)
                $risk_ggt = 0.01;
            else if ($ggt >= 40 and $ggt < 47)
                $risk_ggt = 0.15;
            else
                $risk_ggt = 0.4;
        } else
            $risk_ggt = 1;

        return $risk_ggt;
    }

    function Alp($alp)
    {
        if ($alp != -2) {
            if ($alp < 30)
                $risk_alp = 0.25;
            else if ($alp >= 30 and $alp < 45)
                $risk_alp = 0.15;
            else if ($alp >= 45 and $alp < 115)
                $risk_alp = 0.02;
            else if ($alp >= 115 and $alp < 130)
                $risk_alp = 0.15;
            else
                $risk_alp = 0.4;
        } else
            $risk_alp = 1;

        return $risk_alp;
    }

    function Ldh($ldh)
    {
        if ($ldh != -2) {
            if ($ldh < 122)
                $risk_ldh = 0.35;
            else if ($ldh >= 122 and $ldh <= 222)
                $risk_ldh = 0.05;
            else
                $risk_ldh = 0.45;
        } else
            $risk_ldh = 1;

        return $risk_ldh;
    }

    function Blr($blr)
    {
        if ($blr != -2) {
            if ($blr < 0.1)
                $risk_blr = 0.15;
            else if ($blr >= 0.1 and $blr <= 1.3)
                $risk_blr = 0.02;
            else
                $risk_blr = 0.4;
        } else
            $risk_blr = 1;
        return $risk_blr;
    }

    function Alb($alb)
    {
        if ($alb != -2) {
            if ($alb > 25)
                $al = $alb / 10;
            else
                $al = $alb;
            if ($al < 3.4)
                $risk_alb = 0.15;
            else if ($al >= 3.4 and $al <= 5.2)
                $risk_alb = 0.02;
            else
                $risk_alb = 0.4;
        } else
            $risk_alb = 1;

        return $risk_alb;
    }
    function rizikF7($ast, $alt, $ggt, $alp, $ldh, $blr, $alb, $gender)
    {
        $risk_formula_filter7 = ($this->Ast($ast) * 3 + $this->Alt($alt) * 3 + $this->Ggt($ggt, $gender) * 3 + $this->Alp($alp) * 2 + $this->Ldh($ldh) * 2 + $this->Blr($blr) * 3 + $this->Alb($alb) * 4) / 20.0;
        return (int) ($risk_formula_filter7 * 100);
    }

    function rizikF8($tsh, $freet4, $freet3, $gender, $age)
    {
        if ($tsh != -2) {
            if ($freet4 >= 1.2 and $freet4 <= 1.3 and $freet3 >= 3.2 and $freet3 <= 3.3)
                if ($tsh > 0 and $tsh < 0.1)
                    $risk_tsh = 0.45;
                else if ($tsh >= 0.1 and $tsh < 0.5)
                    $risk_tsh = 0.35;
                else if ($tsh >= 0.5 and $tsh < 1.3)
                    $risk_tsh = 0.15;
                else if ($tsh >= 1.3 and $tsh < 1.8)
                    $risk_tsh = 0.01;
                else if ($tsh >= 1.8 and $tsh < 5.0)
                    $risk_tsh = 0.18;
                else if ($tsh >= 5.0 and $tsh < 7.0)
                    $risk_tsh = 0.25;
                else if ($tsh >= 7.0 and $tsh < 10.0)
                    $risk_tsh = 0.4;
                else
                    $risk_tsh = 0.55;
            else if (($freet4 >= 0.8 and $freet4 < 1.2) or ($freet3 >= 2.3 and $freet3 < 3.2))
                $risk_tsh = 0.12;
            else if (($freet4 > 1.3 and $freet4 < 1.8) or ($freet3 > 3.3 and $freet3 < 4.2))
                $risk_tsh = 0.2;
            else if (($freet4 >= 1.8) or ($freet3 >= 4.2))
                $risk_tsh = 0.25;
            else if (($freet4 > 0 and $freet4 < 0.8) or ($freet3 >= 0 and $freet3 < 2.3))
                $risk_tsh = 0.3;
            if ($age >= 65)
                $risk_tsh = $risk_tsh * 1.12;
        } else
            $risk_tsh = 1;
        return $risk_tsh;
    }

    function Rate($rate_value, $rate_status)
    {
        if ($rate_value != -2 and $rate_status != -2) {
            $rv = $rate_value;
            $rs = $rate_status;
            $rt_values = [[20, 40, 0.35, 0.7], [40, 60, 0.25, 0.8], [60, 100, 0.01, 0.99], [100, 150, 0.2, 0.83], [
                150, 200, 0.3, 0.75
            ], [200, 250, 0.45, 0.55], [250, 300, 0.55, 0.45], [300, 500, 0.8, 0.2]];
            if ($rs == 0)
                $risk_rate = 0.45;
            else if ($rs == -1)
                $risk_rate = 0.55;
            else if ($rs == 1)
                foreach ($rt_values as $hr) {
                    if ($rv >= $hr[0] and $rv < $hr[1])
                        $risk_rate = $hr[2];
                }
            else
                $risk_rate = 0.85;
        } else
            $risk_rate = 1;
        return $risk_rate;
    }

    function P_wave($p_status, $p_value)
    {
        $ps = $p_status;
        $pv = $p_value;
        if ($ps != -2 and $pv != -2) {
            if ($ps == -1)
                $risk_p = 0.3;
            else if ($ps == 0)
                $risk_p = 0.2;
            else if ($ps == 2)
                $risk_p = 0.15;
            else if ($ps == 3)
                $risk_p = 0.25;
            else {
                if ($pv >= 0.06 and $pv <= 0.11)
                    $risk_p = 0.01;
                else if ($pv < 0.06 and $pv >= 0.03)
                    $risk_p = 0.15;
                else if ($pv > 0.11 and $pv <= 0.14)
                    $risk_p = 0.2;
                else
                    $risk_p = 0.25;
            }
        } else
            $risk_p = 1;
        return $risk_p;
    }

    function QRS_complex($qrs_status, $qrs_value)
    {
        $qrss = $qrs_status;
        $qrsv = $qrs_value;
        if ($qrss != -2 and $qrsv != -2) {
            if ($qrss == -1)
                $risk_qrs = 0.75;
            else if ($qrss == 0)
                $risk_qrs = 0.65;
            else if ($qrss == 3)
                $risk_qrs = 0.6;
            else if ($qrss == 2) {
                if ($qrsv > 0.10 and $qrsv <= 0.12)
                    $risk_qrs = 0.4;
                else
                    $risk_qrs = 0.5;
            } else {
                if ($qrsv >= 0.08 and $qrsv <= 0.1)
                    $risk_qrs = 0.01;
                else if ($qrsv < 0.08 and $qrsv >= 0.6)
                    $risk_qrs = 0.15;
                else
                    $risk_qrs = 0.25;
            }
        } else
            $risk_qrs = 1;
        return $risk_qrs;
    }

    function PR_interval($pr_status, $pr_value)
    {
        $prs = $pr_status;
        $prv = $pr_value;
        if ($prs != -2 and $prv != -2) {
            if ($prs == -1)
                $risk_pr = 0.3;
            else if ($prs == 0)
                $risk_pr = 0.2;
            else if ($prs == 2)
                $risk_pr = 0.15;
            else {
                if ($prv >= 0.12 and $prv <= 0.2)
                    $risk_pr = 0.01;
                else if ($prv < 0.12 and $prv >= 0.09)
                    $risk_pr = 0.15;
                else if ($prv > 0.2 and $prv <= 0.24)
                    $risk_pr = 0.2;
                else
                    $risk_pr = 0.25;
            }
        } else
            $risk_pr = 1;
        return $risk_pr;
    }

    function Arythmia($rhythm_status, $rate_value, $p_status, $pr_status, $qrs_status)
    {
        # [rhythm, low_rate, high_rate, p, pr, qrs, anomalia, risk, quality]
        $aryt = [
            [1, 50, 120, -1, -1, 3, "accelerated idioventric. rhythm", 0.65, 0.4], [1, 60, 100, 2, 2, 1, "accelerated junctional rhythm", 0.4, 0.65], [2, 350, 500, -1, -1, 1, "atrial fibrilation", 0.7, 0.35], [2, 250, 350, 0, 0, 1, "atrial flutter", 0.65, 0.4], [1, 20, 60, 1, 1, 2, "bundle branch block", 0.5, 0.55], [1, 60, 100, 1, 1, 2, "first degree heart block", 0.3, 0.75], [1, 20, 40, -1, 0, 3, "idioventricular rhythm", 0.25, 0.85], [1, 40, 60, 2, 0, 1, "junctional escape rhythm", 0.25, 0.8], [1, 100, 180, 2, 2, 1, "junctional tachycardia", 0.15, 0.85], [2, 100, 260, 2, 2, 1, "multifocal atrial tachycardia", 0.4, 0.65], [2, 60, 120, 1, 2, 1, "premature atrial complex", 0.55, 0.5], [1, 60, 100, 2, 2, 1, "premature junctional complex", 0.3, 0.75], [2, 60, 100, -1, 0, 3, "premature ventricular complex", 0.3, 0.75],
            [1, 150, 250, 2, 1, 1, "supraventricular tachycardia", 0.4, 0.65], [2, 40, 80, 2, 0, 2, "third degree heart block", 0.75, 0.3], [2, 0, 20, -1, -1, -1, "ventricular fibrillation", 0.9, 0.1], [1, 100, 250, -1, 0, 3, "ventricular tachycardia monomorphic", 0.55, 0.5], [2, 100, 300, -1, 0, 3, "ventricular tachycardia polymorphic", 0.65, 0.4], [2, 200, 250, -1, -1, 0, "ventricular tachycardia torsade de points", 0.7, 0.3], [2, 60, 100, 1, 2, 1, "second degree heart block type I", 0.5, 0.55], [3, 40, 100, 1, 2, 2, "second degree heart block type II", 0.6, 0.45], [2, 40, 100, 1, 1, 2, "sinoatrial block", 0.55, 0.5], [2, 40, 80, 1, 1, 2, "sinus arrest", 0.5, 0.5], [2, 60, 100, 1, 1, 1, "sinus arythmia", 0.25, 0.8], [1, 20, 60, 1, 1, 1, "sinus bradycardia", 0.2, 0.85], [1, 100, 250, 2, 1, 1, "sinus tachycardia", 0.35, 0.7]
        ];
        foreach ($aryt as $x) {
            if ($rhythm_status == $x[0] and $rate_value >= $x[1] and $rate_value <= $x[2] and $p_status == $x[3] and $pr_status == $x[4] and $qrs_status == $x[5])
                $risk_aryth = $x[7];
            else
                $risk_aryth = 0.01;
        }
        return $risk_aryth;
    }

    function ST($st_value, $st_status)
    {
        $stv = $st_value;
        $sts = $st_status;
        if ($stv != -2 and $sts != -2) {
            if ($sts == -1)
                $risk_st = 0.65;
            else if ($sts == 0)
                $risk_st = 0.5;
            else if ($sts == 2)
                $risk_st = 0.7;
            else if ($sts == 3)
                $risk_st = 0.85;
            else {
                if ($stv >= 0.27 and $stv <= 0.33)
                    $risk_st = 0.01;
                else if ($stv < 0.27 and $stv >= 0.23)
                    $risk_st = 0.15;
                else if ($stv > 0.33 and $stv <= 0.37)
                    $risk_st = 0.2;
                else
                    $risk_st = 0.35;
            }
        }
        return $risk_st;
    }

    function T_wave($t_value, $t_status)
    {
        $tv = $t_value;
        $ts = $t_status;
        if ($tv != -2 and $ts != -2) {
            if ($ts == 2)
                $risk_t = 0.65;
            else {
                if ($tv <= 0.24 and $tv >= 0.15)
                    $risk_t = 0.05;
                else
                    $risk_t = 0.4;
            }
        }
        return $risk_t;
    }

    function Rhythm($rhythm_status, $rhythm_value)
    {
        $rtms = $rhythm_status;
        $rtmv = $rhythm_value;
        if ($rtms != -2 and $rtmv != -2) {
            if ($rtms == -1)
                $risk_rhythm = 0.99;
            else if ($rtms == 2)
                $risk_rhythm = 0.4;
            else if ($rtms == 3)
                $risk_rhythm = 0.5;
            else
                $risk_rhythm = 0.05;
        }
        return $risk_rhythm;
    }

    function D_wave($d_status)
    {
        $ds = $d_status;
        if ($ds != -2) {
            if ($ds == 1)
                $risk_d = 0.02;
            else
                $risk_d = 0.15;
        }
        return $risk_d;
    }

    function U_wave($u_status, $u_value)
    {
        $us = $u_status;
        $uv = $u_value;
        if ($us != -2 and $uv != -2) {
            # U wave status  1 ima ga, 2 abnoramalan
            if ($us == 1) {
                if ($uv >= 0.16 and $uv <= 0.22)
                    $risk_u = 0.01;
                else
                    $risk_u = 0.2;
            } else
                $risk_u = 0.45;
        }
        return $risk_u;
    }

    function LastEKG($age, $last, $frequency)
    {
        $a = $age;
        $l = $last;
        $f = $frequency;
        if ($a >= 40 and $a < 50) {
            if ($l == -1)
                $risk_last = 0.1;
            else if ($l <= 3) {
                if ($f >= 1 and $f <= 2)
                    $risk_last = 0.3;
                else if ($f < 1)
                    $risk_last = 0.35;
                else
                    $risk_last = 0.4;
            } else if ($l > 3 and $l <= 6) {
                if ($f >= 1 and $f <= 2)
                    $risk_last = 0.25;
                else if ($f < 1)
                    $risk_last = 0.3;
                else
                    $risk_last = 0.35;
            } else {
                if ($f >= 1 and $f <= 2)
                    $risk_last = 0.22;
                else if ($f < 1)
                    $risk_last = 0.28;
                else
                    $risk_last = 0.38;
            }
        } else if ($a >= 50 and $a < 60) {
            if ($l == -1)
                $risk_last = 0.15;
            else if ($l <= 3)
                if ($f >= 1 and $f <= 2)
                    $risk_last = 0.4;
                else if ($f < 1)
                    $risk_last = 0.45;
                else
                    $risk_last = 0.5;
            else if ($l > 3 and $l <= 6) {
                if ($f >= 1 and $f <= 2)
                    $risk_last = 0.35;
                else if ($f < 1)
                    $risk_last = 0.4;
                else
                    $risk_last = 0.45;
            } else {
                if ($f >= 1 and $f <= 2)
                    $risk_last = 0.32;
                else if ($f < 1)
                    $risk_last = 0.38;
                else
                    $risk_last = 0.48;
            }
        } else if ($a >= 60 and $a < 70) {
            if ($l == -1)
                $risk_last = 0.35;
            else if ($l <= 3) {
                if ($f >= 1 and $f <= 2)
                    $risk_last = 0.5;
                else if ($f < 1)
                    $risk_last = 0.55;
                else
                    $risk_last = 0.6;
            } else if ($l > 3 and $l <= 6) {
                if ($f >= 1 and $f <= 2)
                    $risk_last = 0.45;
                else if ($f < 1)
                    $risk_last = 0.5;
                else
                    $risk_last = 0.55;
            } else {
                if ($f >= 1 and $f <= 2)
                    $risk_last = 0.42;
                else if ($f < 1)
                    $risk_last = 0.48;
                else
                    $risk_last = 0.58;
            }
        } else if ($a >= 70) {
            if ($l == -1)
                $risk_last = 0.45;
            else if ($l <= 3) {
                if ($f >= 1 and $f <= 2)
                    $risk_last = 0.6;
                else if ($f < 1)
                    $risk_last = 0.65;
                else
                    $risk_last = 0.7;
            } else if ($l > 3 and $l <= 6) {
                if ($f >= 1 and $f <= 2)
                    $risk_last = 0.55;
                else if ($f < 1)
                    $risk_last = 0.6;
                else
                    $risk_last = 0.65;
            } else {
                if ($f >= 1 and $f <= 2)
                    $risk_last = 0.52;
                else if ($f < 1)
                    $risk_last = 0.58;
                else
                    $risk_last = 0.68;
            }
        } else {
            if ($l == -1)
                $risk_last = 0.01;
            else if ($l <= 3) {
                if ($f >= 1 and $f <= 2)
                    $risk_last = 0.15;
                else if ($f < 1)
                    $risk_last = 0.2;
                else
                    $risk_last = 0.25;
            } else if ($l > 3 and $l <= 6) {
                if ($f >= 1 and $f <= 2)
                    $risk_last = 0.2;
                else if ($f < 1)
                    $risk_last = 0.25;
                else
                    $risk_last = 0.25;
            } else {
                if ($f >= 1 and $f <= 2)
                    $risk_last = 0.12;
                else if ($f < 1)
                    $risk_last = 0.18;
                else
                    $risk_last = 0.28;
            }
        }
        return $risk_last;
    }
    function rizikEKG($rhythm_status, $rhythm_value, $rate_status, $rate_value, $p_status, $p_value, $pr_status, $pr_value, $qrs_status, $qrs_value, $t_status, $t_value, $st_status, $st_value, $u_status, $u_value, $d_status, $last, $frequency, $gender, $age)
    {
        $rizikEKG = (10 * $this->Rate($rate_value, $rate_status) +  7 * $this->P_wave($p_status, $p_value) + 7 * $this->QRS_complex($qrs_status, $qrs_value) + 6 * $this->PR_interval($pr_status, $pr_value) + 9 * $this->Arythmia($rhythm_status, $rate_value, $p_status, $pr_status, $qrs_status) + 4 * $this->ST($st_value, $st_status) + 4 * $this->T_wave($t_value, $t_status) + 10 * $this->Rhythm($rhythm_status, $rhythm_value) + 5 * $this->D_wave($d_status) + 6 * $this->U_wave($u_status, $u_value) + 6 * $this->LastEKG($age, $last, $frequency)) / 74;
        return (int) ($rizikEKG * 100);
    }
}
